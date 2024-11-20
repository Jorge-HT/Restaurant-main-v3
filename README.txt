Woah I wonder what those Composer files are! 
The idea was to ask the user for their email, and be able to send them their order. 
I haven't quiet figured it out yet or even know if this is going to stay
in future implementations. 

But here we are. Composer has to be installed so I included the steps below:
Download composer: https://getcomposer.org/doc/00-intro.md#installation-windows

Step 1: Ensure Composer is Installed
Verify Composer Installation:
Open a new terminal or command prompt and type:
composer --version

Once Composer is installed, open the VSCode terminal again and run the command to initialize 
Composer in your project:
composer init

Step 2: Install PHPMailer
After initializing Composer, run:
composer require phpmailer/phpmailer

================================================================================================
Project update
organized the files because lowkey it was bothering me that the food images were in the same directory
as the html files. so everything is in their own folders. also makes it easier to reread code and find
specific things.

I added "Add to Plate" functions where the items show below Plate Progress. In black text so its hard
to see. 
issues would be that when you switch pages, the list doesn't show up until you add something else, so
that needs to be fixed. otherwise the text file does update when you press the "add to plate" buttons!

Started work on the checkout page, absolutely bare bones, no css added yet for that. Again, tried
adding it so you can enter email and get your recipt. Not yet completed, but you do get your total!

Another bug is that the kids menu is kind of messed up visually. oops. 

BUTT overall this is a big step forward mhm mhm

drinks are also broken right now, they dont technically have a price with them so they dont 
get added to the order. must fix that too.
