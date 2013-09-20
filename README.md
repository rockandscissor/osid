osid
====

Open Source Image Duplicator is a simple web-based UI script that allows you to build a low cost Duplicator for USB Drives, SD Cards, or any other type of media that an image file can be written to using the dd command.

The components used on our test device were as follows:

1 x Raspberry Pi Model B Revision 2
1 x MicroUSB 1500mA Power Supply
1 x Powered USB Hub with 10 ports/7 ports (see notes on hardware compatibility)
10 x USB MicroSD Card Adaptors

We recommend running Arch Linux ARM on the Raspberry Pi due to it being a simple lightweight linux distro that boots in around 10-20 seconds. We used Nginx with php-fpm as we found early on that Apache2 isn't particulary stable on the Raspberry Pi and consumes a large amount of resources when compared to Nginx.

We will make an image file available of the complete Arch Linux ARM Image with OSID pre-installed (including step by step instructions) at http://www.rockandscissor.com/projects/osid upon completion of the project.

This project was created by Matthew Stone (matthew.stone@rockandscissor.com) and released under the GNU GPLv3 license by Rock & Scissor Enterprises Limited.

If you have any questions/comments/feedback please contact Matthew on the email listed above and he'll do his best to help you out.

Hardware Compatibility
======================

It's worth noting that our initial prototype kept causing kernal panics when we tried to write to the memory sticks. We narrowed this down to the TeckNet USB 3.0 10-port hub we had purchased not being compatible with the Raspberry Pi, whether this is because of it being a USB 3.0 hub (the RPi is USB 2.0), or more likely power issues backfeeding into the RPi, we decided to obtain a new hub based on the list confirmed to work with the RPi found at http://elinux.org/RPi_Powered_USB_Hubs.
