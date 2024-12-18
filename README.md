
# Web Scraper

This is a simple web scraper built using Goutte, a PHP library for web scraping. It is designed to scrape data from the **BookstoScrape** website, specifically targeting the pages that list books.

## Installation

### Step 1: Install Composer
If you don't already have Composer installed, you can install it by following these steps:

1. Download and install Composer by visiting [https://getcomposer.org/download/](https://getcomposer.org/download/).
2. Make sure `composer` is available globally in your terminal.

### Step 2: Install Goutte using Composer

Once Composer is installed, follow these steps to install Goutte:

1. Open a terminal and navigate to your project directory.

2. Install the composer
   composer install
   
3. Run the following command
 composer require fabpot/goutte

4. Create database (scraping_data.sql)

5. Run php page http://localhost/FINAL-WEB-SCRAPER/scraper-form.php

6. Enter URL https://books.toscrape.com/catalogue/page-1.html
   wait for scraping...

--------------------------------------------------------------------
Summarize data using groqapi 

1. Please run this on database

SET SESSION group_concat_max_len = 1000000;

2. Just click the Summarize Data Analysis button on product-list page to get summarize data.

--------------------End----------------------------

