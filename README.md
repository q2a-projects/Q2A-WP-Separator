# Q2A WordPress Separator [![Question2Answer](http://qa-themes.com/files/q2a-logo.png)](http://www.question2answer.org/) [![Question2Answer Themes](http://qa-themes.com/files/qa-logo.jpg)](http://qa-themes.com/)

# Description
This script breaks Q2A-WP integration by creating Q2A's User related database tables which were not created because of integration and importing all WP users to Q2A tables.

## Important Disclaimer

This script comes with no warranties. we accept no responsibility for any damage on downtime you might have on your site.

**if you are not a developer I suggest that you hire one to make this separation.**

**in any case make sure that you have a full backup of your site before implementing any changes.**

# Installation
1. upload separator's directory inside Q2A's root directory (so you probably will have `Q2A.com/separator` or `Q2A.WP.com/separator` or `WP.com/Q2A/separator`).
2. visit Separator's directory in your web browser.
3. Click **Start It!** button.
4. if you didn't get any errors, then in your Q2A directory open `qa-config.php` and remove this line: `define('QA_WORDPRESS_INTEGRATE_PATH', 'PATH TO WORDPRESS DIRECTORY');`
5. Visit your Q2A site & click on **Repair Database** button.

# Author
This free script is developed by [Towhid Nategheian](http://TowhidN.com), a freelance web developer and designer. you can check my Q2A themes and plugins on [QA-Themes.com](http://QA-Themes.com).

## Copyright
this plugin and all it's source code is [Copylefted](http://en.wikipedia.org/wiki/Copyleft)

## Support
if you are not a Q2A developer, you can hire us or any other professional developer to apply this separation.
otherwise of you had any problems you can use [Q2A's official Q&A site](http://question2answer.org/qa/) or start a topic on our [Q2A Support Forum](http://qa-themes.com/support/).

if you are a developer and you want to participate in this project feel free to submit an issue on github or fork the project.

# About Question2Answer

[Question2Answer](http://qa-themes.com/question2answer) is a free and open source platform for creating Question&Answer communities.
