# webdav-recursive-upload
A tiny PHP script to upload data recursively to a webdav server

## About Recursive WebDav Upload
Basically I wrote this script to transfer the data of one of my clients to his new ownCloud instance. This script successfully uploaded ~900GB data to his ownCloud server over its webDav interface. Although I have written this for ownCloud but the script should work on all kind of webDav interfaces.

## How to Use
You have two ways to use this script. You can either use the script in your PHP project to automate the backup of any website or can use to just do a one-time transfer of the data. This comes handy when you don't have SSH access and if you want to transfer the publicly available data on your websites to transfer elsewhere over webDav. To use that way, simply clone or download the webdav_recursive_upload.php file and include it in your project.

To use this script to transfer the data using SSH, first SSH into the server, cd into the root directory that you want to upload including all sub directories in it and then clone or copy the webdav_recursive_upload.php file into that directory. After that, edit the file and provide the target webDav credentials. Make the file executable (chmod +x webdav_recursive_upload.php) and execute it (./webdav_recursive_upload.php). The script will start uploading the data.

###### Data too large?
If you are going to upload too large data, then consider running the script in background so your terminal session doesn't interrupt the transfer. To do that, first execute the script (./webdav_recursive_upload.php), then push it to the background by first pressing CTRL+Z and then by typing bg in the terminal.


#### Don't forget to edit the file and provide your own webDav credentials.
