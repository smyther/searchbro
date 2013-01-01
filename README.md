searchbro
=========

A simple nzbs.org API powered downloadery thing.

This 'app' allows you to search nzbs.org and throw NZB's from there directly to your own SABnzbd+ install. You can also set up your own custom search categories which will automagically get added to the top bar for easy access.

You can see a screenshot of it in action <a href="https://raw.github.com/smyther/searchbro/master/screenshot.png">here</a>.

Installing
---

Clone into your web directory (or wherever you like).

Edit includes/config.php and add your URL and API Keys (nzbs.org API key is in your user settings).

Note: You should use the SABnzbd+ NZB API key. The general API key will probably work, but I haven't tried it.

Visit the URL you cloned into. Win.

Custom Categories
---

Open includes/config.php, edit the $categories array using categories from http://beta.nzbs.org/api?t=caps - you can call the categories whatever you like. Array key is your category name, array value is comma separated list of categories.

Erm
---

That's it really. Bear in mind I wrote this in about 3 hours. It's not clean. It's not pretty, but it works.

Please, add anything you feel like it needs.

