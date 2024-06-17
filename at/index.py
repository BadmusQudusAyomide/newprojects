import os

# Define the directory paths
dataset_dir = "dataset"
attendance_dir = "attendance"

# Create the dataset directory if it doesn't exist
if not os.path.exists(dataset_dir):
    os.makedirs(dataset_dir)
    print(f"Directory '{dataset_dir}' created successfully.")
else:
    print(f"Directory '{dataset_dir}' already exists.")

# Create the attendance directory if it doesn't exist
if not os.path.exists(attendance_dir):
    os.makedirs(attendance_dir)
    print(f"Directory '{attendance_dir}' created successfully.")
else:
    print(f"Directory '{attendance_dir}' already exists.")
