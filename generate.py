import qrcode

# URL of your HTML file
url = "https://7875-103-190-198-174.ngrok-free.app/project/"  # Change this to your actual URL

# Generate QR code
qr = qrcode.QRCode(version=1, box_size=10, border=5)
qr.add_data(url)
qr.make(fit=True)

# Create an image from the QR Code instance
img = qr.make_image(fill='black', back_color='white')

# Save the image
img.save("qrcode.png")