Magecom_Donation module:

This module is developed as a test task.

Install:

To install this module clone or copy this module into /app/code
and run the next commands from /bin folder:


php magento module:enable Magecom_Donation
php magento setup:upgrade
php magento setup:static-content:deploy



Module usage:

You can configuration this module from Store -> Configuration -> Donation -> Configuration.
On the checkout page on the payment step you can see checkbox for donation with all configuration from admin area(Title, Rates).

You should choose one of them rates for adding `donation` to Order Summary, after that you can see new total to `Sidebar` with you donation.