curl --request POST \
  --url 'https://your-jira-instance.atlassian.net/rest/api/2/issue' \
  --user 'your_email@example.com:YOUR_ATLASSIAN_JIRA_TOKEN' \
  --header 'Accept: application/json' \
  --header 'Content-Type: application/json' \
  --data '{
    "fields": {
      "project": {
        "key": "B"
      },
      "parent": {
        "key": "B-586"
      },
      "summary": "Implement feature X for subtask in BFDS-586",
      "description": "This subtask covers the implementation details for feature X related to the main task BFDS-586.",
      "issuetype": {
        "name": "Sub-task"
      },
      "assignee": {
        "accountId": "your_assignee_account_id"
      },
      "reporter": {
        "accountId": "your_reporter_account_id"
      }
    }
  }' \
  --compressed



#!/bin/bash

# Path to config 

# Check if config file exists
if [ ! -f "$CONFIG_FILE" ]; then
    echo "Error: Config file $CONFIG_FILE not found"
    exit 1
fi

# Read token from config file
TOKEN=$(awk -F'=' '/token/ {print $2}' "$CONFIG_FILE" | tr -d '[:space:]')

if [ -z "$TOKEN" ]; then
    echo "Error: Token not found in config file"
    exit 1
fi

# URL to call (replace with your actual URL)
URL="https://your-api-endpoint.com"

# Make curl request
RESPONSE=$(curl -s -H "Authorization: Bearer $TOKEN" "$URL")

# Check if response contains error: false
if echo "$RESPONSE" | grep -q '"error": *false'; then
    echo "Request successful: error is false"
else
    echo "Request failed: error is not false"
    echo "Response: $RESPONSE"
    exit 1
fiimport cv2
import numpy as np
import matplotlib.pyplot as plt
from skimage.restoration import denoise_wavelet
from skimage.color import rgb2gray
from skimage.filters import unsharp_mask
from skimage.metrics import peak_signal_noise_ratio as psnr_metric
from skimage.metrics import structural_similarity as ssim_metric

# Removed calculate_sharpness_laplacian and calculate_sharpness_tenengrad as requested.

def compare_enhancement_methods_automated(image_path):
    """
    Compares different image enhancement (denoising, sharpening) methods
    specifically for images with visual noise, and automatically recommends
    the best one based on PSNR and SSIM.
    """
    image_bgr = cv2.imread(image_path)

    if image_bgr is None:
        print(f"Error: Could not load image from {image_path}")
        return

    # Original images for reference, converted to float (0-1) and grayscale float
    original_rgb_uint8 = cv2.cvtColor(image_bgr, cv2.COLOR_BGR2RGB)
    original_float = original_rgb_uint8.astype(np.float64) / 255.0
    original_gray_float = rgb2gray(original_float)

    # Dictionary to store results: {method_name: (processed_image_for_display, psnr, ssim)}
    results = {}

    # --- Original Image (for baseline) ---
    # PSNR of original vs original is typically infinity (due to 0 MSE).
    # SSIM of original vs original is 1.0.
    original_psnr = psnr_metric(original_float, original_float, data_range=1.0)
    original_ssim = ssim_metric(original_gray_float, original_gray_float, data_range=1.0)
    results['Original Image'] = (original_rgb_uint8, original_psnr, original_ssim)
    print(f"Original Image - PSNR: {original_psnr:.2f}, SSIM: {original_ssim:.4f}")

    # --- Denoising Methods (Main Focus for "Visual Noise") ---

    # Define methods and their processing functions
    methods_to_process = [
        ("Gaussian Blur (5x5)", lambda img: cv2.GaussianBlur(img, (5, 5), 0)),
        ("Median Blur (5)", lambda img: cv2.medianBlur(img, 5)),
        ("Bilateral Filter (9, 75, 75)", lambda img: cv2.bilateralFilter(img, 9, 75, 75)),
        ("Fast NlMeans Denoising", lambda img: cv2.fastNlMeansDenoisingColored(img, None, 10, 10, 7, 21)),
        ("Wavelet Denoising", lambda img_f: denoise_wavelet(img_f, channel_axis=-1, method='BayesShrink', mode='soft'))
    ]

    for name, func in methods_to_process:
        processed_image_bgr = None
        processed_image_float = None

        if name == "Wavelet Denoising":
            # Wavelet denoise works with float images (0-1) and returns float RGB
            processed_image_float = func(original_float)
            display_image = processed_image_float # Keep float for display
        else:
            # OpenCV functions work with uint8 BGR and return uint8 BGR
            processed_image_bgr = func(image_bgr)
            # Convert to RGB for display and to float RGB for PSNR/SSIM
            display_image = cv2.cvtColor(processed_image_bgr, cv2.COLOR_BGR2RGB)
            processed_image_float = display_image.astype(np.float64) / 255.0

        # Calculate PSNR (requires float 0-1 images)
        psnr = psnr_metric(original_float, processed_image_float, data_range=1.0)
        
        # Calculate SSIM (requires grayscale float 0-1 images)
        processed_gray_float = rgb2gray(processed_image_float)
        ssim = ssim_metric(original_gray_float, processed_gray_float, data_range=1.0, channel_axis=None)

        results[name] = (display_image, psnr, ssim)
        print(f"{name} - PSNR: {psnr:.2f}, SSIM: {ssim:.4f}")

    # --- Sharpening Method (Apply after denoising for best results) ---
    # Unsharp Masking
    try:
        sharpened_image_unsharp_float = unsharp_mask(original_float, radius=1.0, amount=1.0, channel_axis=-1)
        
        psnr_unsharp = psnr_metric(original_float, sharpened_image_unsharp_float, data_range=1.0)
        ssim_unsharp = ssim_metric(original_gray_float, rgb2gray(sharpened_image_unsharp_float), data_range=1.0, channel_axis=None)

        results['Unsharp Masking'] = (sharpened_image_unsharp_float, psnr_unsharp, ssim_unsharp)
        print(f"Unsharp Masking - PSNR: {psnr_unsharp:.2f}, SSIM: {ssim_unsharp:.4f}")
    except Exception as e:
        print(f"Error applying Unsharp Masking: {e}")
        # Fallback if unsharp masking fails
        results['Unsharp Masking'] = (original_float, original_psnr, original_ssim)


    # --- Automated Best Method Selection ---
    best_method = None
    best_psnr = -1 # Initialize with a low value
    best_ssim = -1.1 # Initialize with a value lower than any possible SSIM (-1 to 1)

    print("\n--- Automated Best Method Selection (Based on SSIM then PSNR) ---")
    
    # Iterate through results to find the best method
    # We will prioritize SSIM, then PSNR for tie-breaking
    for method_name, (img_display, current_psnr, current_ssim) in results.items():
        # Skip the original image from automated selection, as we are looking for an *improvement*
        if method_name == 'Original Image':
            continue

        # If current SSIM is better, or (SSIM is equal AND PSNR is better), update best
        if current_ssim > best_ssim:
            best_ssim = current_ssim
            best_psnr = current_psnr
            best_method = method_name
        elif current_ssim == best_ssim and current_psnr > best_psnr:
            best_psnr = current_psnr
            best_method = method_name

    if best_method:
        print(f"Recommended best method: '{best_method}'")
        print(f"  PSNR: {results[best_method][1]:.2f}, SSIM: {results[best_method][2]:.4f}")
    else:
        print("Could not determine a best method among the processed images.")


    # --- Visualization ---
    num_methods = len(results)
    cols = 3 # Arrange in 3 columns for better comparison
    rows = int(np.ceil(num_methods / cols))
    if rows == 0: rows = 1

    fig, axes = plt.subplots(rows, cols, figsize=(cols * 5, rows * 5))
    axes = axes.flatten()

    for i, (method_name, (processed_image_raw, psnr_val, ssim_val)) in enumerate(results.items()):
        ax = axes[i]
        
        # Determine display image based on its type (float RGB for skimage, uint8 BGR for opencv)
        if processed_image_raw.dtype == np.uint8:
            display_image = processed_image_raw # This assumes it's already RGB for display (converted earlier)
        else: # Assumed float RGB from scikit-image
            display_image = processed_image_raw

        ax.imshow(display_image)
        ax.set_title(f"{method_name}\nPSNR: {psnr_val:.2f}, SSIM: {ssim_val:.4f}")
        ax.axis('off')

    # Hide any unused subplots
    for j in range(i + 1, len(axes)):
        fig.delaxes(axes[j])

    plt.tight_layout()
    plt.show()

# --- How to use ---
# Replace "1.jpg" with the actual path to your noisy image file.
# You can uncomment and use the other image paths (IMG_5073.jpg, IMG_5072.jpg) to test.
# Make sure these image files are in the same directory as your Python script.
compare_enhancement_methods_automated("1.jpg")
# compare_enhancement_methods_automated("IMG_5073.jpg")
# compare_enhancement_methods_automated("IMG_5072.jpg")




from pyspark.sql import SparkSession
import subprocess

# Initialize Spark session
spark = SparkSession.builder.appName("SendHTMLEmail").getOrCreate()

# HTML content (example, can be dynamically generated)
html_content = """
<html>
  <body>
    <h1>Test Email from PySpark</h1>
    <p>This is a <b>bold</b> HTML email sent using the mail command!</p>
  </body>
</html>
"""

# Email details
recipient = "recipient@example.com"
subject = "Test Email from PySpark"
email_content = f"""To: {recipient}
Subject: {subject}
Content-Type: text/html

{html_content}
"""

# Define the mail command
command = ["mail", "-t"]

try:
    # Execute mail command and pipe email content
    process = subprocess.Popen(
        command,
        stdin=subprocess.PIPE,
        stdout=subprocess.PIPE,
        stderr=subprocess.PIPE,
        text=False  # Use bytes for compatibility
    )
    stdout, stderr = process.communicate(input=email_content.encode())
    
    if process.returncode == 0:
        print("Email sent successfully")
    else:
        print(f"Failed to send email: {stderr.decode()}")
except Exception as e:
    print(f"Error sending email: {str(e)}")

# Stop Spark session
spark.stop()




from pyspark.sql import SparkSession
import subprocess
import os # Import os for potential environment variables

# Initialize Spark session
spark = SparkSession.builder.appName("SendHTMLEmail").getOrCreate()

# HTML content (example, can be dynamically generated)
html_content = """
<html>
  <body>
    <h1>Test Email from PySpark</h1>
    <p>This is a <b>bold</b> HTML email sent using the mail command!</p>
  </body>
</html>
"""

# Email details
recipient = "recipient@example.com" # REPLACE WITH A REAL RECIPIENT FOR TESTING
subject = "Test Email from PySpark"

# The structure of the email content for 'mail -t' is crucial.
# It expects RFC 822 formatted message.
email_message = f"""From: PySpark Sender <no-reply@yourcompany.com>
To: {recipient}
Subject: {subject}
Content-Type: text/html; charset="UTF-8"
MIME-Version: 1.0

{html_content}
"""

# Define the mail command
# -t reads To:, Cc:, Bcc: headers from stdin
# -s for subject can be used, but since we're piping, it's better to put in headers
command = ["mail", "-t"] # Using -t is good here

try:
    print(f"Attempting to send email to: {recipient} with subject: {subject}")
    # print(f"Email content being sent:\n{email_message}") # Uncomment for debugging

    # Execute mail command and pipe email content
    process = subprocess.Popen(
        command,
        stdin=subprocess.PIPE,
        stdout=subprocess.PIPE,
        stderr=subprocess.PIPE,
        # text=True is often safer if you're directly passing a string
        # and letting Python handle encoding. Let's try that.
        text=True # This means input must be a string, and Python handles encoding (UTF-8 by default)
    )
    # The 'input' parameter expects a string when text=True
    stdout, stderr = process.communicate(input=email_message)

    if process.returncode == 0:
        print("Email sent successfully")
        if stdout:
            print(f"Mail command stdout: {stdout.strip()}")
    else:
        print(f"Failed to send email. Return code: {process.returncode}")
        if stdout:
            print(f"Mail command stdout: {stdout.strip()}")
        if stderr:
            print(f"Mail command stderr: {stderr.strip()}")

except FileNotFoundError:
    print("Error: 'mail' command not found. Make sure it's installed and in your PATH.")
except Exception as e:
    print(f"Error sending email: {str(e)}")

# Stop Spark session
spark.stop()



mailx -a "Content-Type: text/html" -s "Your Subject" recipient@example.com < email_body.html

