import cv2
import numpy as np
from skimage.restoration import denoise_wavelet
from skimage.metrics import peak_signal_noise_ratio as psnr
import matplotlib.pyplot as plt

# Load image (assuming grayscale for simplicity)
image_path = 'your_image.jpg'  # Replace with actual path
original = cv2.imread(image_path, cv2.IMREAD_GRAYSCALE)

# Apply denoising methods
gaussian = cv2.GaussianBlur(original, (5, 5), 0)
median = cv2.medianBlur(original, 5)
bilateral = cv2.bilateralFilter(original, 9, 75, 75)
nl_means = cv2.fastNlMeansDenoising(original, None, 10, 7, 21)
wavelet = denoise_wavelet(original, channel_axis=None, method='BayesShrink', mode='soft')
wavelet = (wavelet * 255).astype(np.uint8)  # Rescale if needed

# Compute PSNR values (assuming original is noisy and clean reference is known)
psnr_values = {
    'Gaussian Blur': psnr(original, gaussian),
    'Median Blur': psnr(original, median),
    'Bilateral Filter': psnr(original, bilateral),
    'Non-Local Means': psnr(original, nl_means),
    'Wavelet Denoising': psnr(original, wavelet),
}

# Select best method
best_method = max(psnr_values, key=psnr_values.get)
print("Best method based on PSNR:", best_method)
print("PSNR values:", psnr_values)

# Show best image
best_image = {
    'Gaussian Blur': gaussian,
    'Median Blur': median,
    'Bilateral Filter': bilateral,
    'Non-Local Means': nl_means,
    'Wavelet Denoising': wavelet
}[best_method]

plt.imshow(best_image, cmap='gray')
plt.title(f'Best Denoised Image: {best_method}')
plt.axis('off')
plt.show()

