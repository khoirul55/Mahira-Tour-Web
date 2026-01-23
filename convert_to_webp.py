
from PIL import Image
import os

files_to_convert = [
    r"public\images\hero\hero-about.jpeg",
    r"public\images\hero\jamaah2.jpeg",
    r"public\images\hero\umrah-januari.jpeg",
    r"public\images\hero\umrah-ramadhan.jpeg",
    r"public\images\hero\umrah-syawal.jpeg",
    r"public\images\partners\kemenag.png",
    r"public\images\partners\himpuh.png",
    r"public\images\partners\siskopatuh.png",
    r"public\images\mahira-logo.png",
    r"public\images\mahira-logo-white.png",
    r"public\images\mahira-logo-transparent.png"
]

base_path = os.getcwd()

print("Starting conversion...")

for relative_path in files_to_convert:
    full_path = os.path.join(base_path, relative_path)
    if os.path.exists(full_path):
        try:
            img = Image.open(full_path)
            # Create new filename with .webp extension
            file_name_without_ext = os.path.splitext(full_path)[0]
            new_path = file_name_without_ext + ".webp"
            
            # Save as WebP
            img.save(new_path, "WEBP", quality=85)
            print(f"Converted: {relative_path} -> {os.path.basename(new_path)}")
        except Exception as e:
            print(f"Error converting {relative_path}: {e}")
    else:
        print(f"File not found: {relative_path}")

print("Conversion complete.")
