osid
====

Open Source Image Duplicator is a simple web-based UI script that allows you to build a low cost Duplicator for USB Drives, SD Cards, or any other type of media that an image file can be written to using the dd command.

The components used on our test device were as follows:

1 x Raspberry Pi Model B Revision 2
1 x MicroUSB 1500mA Power Supply
1 x Powered USB 3.0 Hub with 10 ports
10 x USB MicroSD Card Adaptors

We recommend running Arch Linux ARM on the Raspberry Pi due to it being a simple lightweight linux distro that boots in around 10-20 seconds. We used Nginx with php-fpm as we found early on that Apache2 isn't particulary stable on the Raspberry Pi and consumes a large amount of resources when compared to Nginx.

We will make an image file available of the complete Arch Linux ARM Image with OSID pre-installed (including step by step instructions) at http://www.rockandscissor.com/projects/osid upon completion of the project.

This project was created by Matthew Stone (matthew.stone@rockandscissor.com) and released under the GNU GPLv3 license by Rock & Scissor Enterprises Limited.

If you have any questions/comments/feedback please contact Matthew on the email listed above and he'll do his best to help you out.