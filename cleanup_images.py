
import os
import glob

def cleanup_legacy_images(base_dir):
    print(f"Cleaning up {base_dir}...")
    # Walk through directory
    for root, dirs, files in os.walk(base_dir):
        for file in files:
            if file.lower().endswith(('.jpg', '.jpeg', '.png')):
                # Check if webp version exists
                file_path = os.path.join(root, file)
                file_name_no_ext = os.path.splitext(file)[0]
                webp_path = os.path.join(root, file_name_no_ext + ".webp")
                
                if os.path.exists(webp_path):
                    try:
                        os.remove(file_path)
                        print(f"Deleted: {file} (WebP replacement exists)")
                    except Exception as e:
                        print(f"Error deleting {file}: {e}")
                else:
                    # Specific check for known unused files or specific renames
                    if file == "kaabah.jpg" and os.path.exists(os.path.join(root, "kaabah.webp")):
                         # Should have been caught above, but just in case of extension mismatch logic
                         pass 

# Define directories to clean
dirs_to_clean = [
    r"public\images",
    r"storage\app\public"
]

base_path = os.getcwd()

for d in dirs_to_clean:
    full_path = os.path.join(base_path, d)
    if os.path.exists(full_path):
        cleanup_legacy_images(full_path)
    else:
        print(f"Directory not found: {full_path}")

# Delete specific unused files identified in report
specific_files = [
    r"public\images\hero\kaabah-poster.jpg.png",
    r"storage\app\public\gallery\jamaah1.webp",
    r"storage\app\public\gallery\jamaah3.webp",
    r"storage\app\public\gallery\makkah1.webp",
    r"storage\app\public\gallery\makkah2.webp",
    r"storage\app\public\gallery\madinah-1.jpeg"
]

for rel_path in specific_files:
    full_path = os.path.join(base_path, rel_path)
    if os.path.exists(full_path):
         try:
            os.remove(full_path)
            print(f"Deleted unused file: {rel_path}")
         except Exception as e:
            print(f"Error deleting {rel_path}: {e}")

print("Cleanup complete.")
