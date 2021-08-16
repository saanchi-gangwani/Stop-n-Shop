# Stop-n-Shop
<p align='center'><img align='center' src='resources/logo_white.png' alt='Stop n Shop Logo' height='300px'/></p>
Welcome to Stop n Shop! SNS is a sample E-commerce website whose backend is completely built on Laravel PHP and MySQL Database. For the frontend, the website uses HTML, CSS, Vanilla JavaScript and some frontend frameworks like Bootstrap and jQuery.<br/>
The site has all the major features of a real-world E-commerce website including registration and logging in of users, cart management, profile management, storage of multiple addresses etc.<br/>
The website uses <a href='https://github.com/vlucas/phpdotenv'>vlucas/phpdotenv</a> project as the only PHP dependency to store environment variables for the connection to the database. Instructions on how to use it are given below.<br/>
The website also has a live Razorpay Payment Gateway Integration in the test mode. In order to to use it on your own, one may use their own Razorpay API key and store it in the .env file as demonstrated in the <a href='config/.env.example'>.env.example</a> file.<br/>

## Disclaimer and Notice
Please note that SNS is not a real website and was built solely for the developers' learning purposes. The website does not aim to violate any kind of copyrights, nor does it aim to be made live for commercial purposes along with the use of any kind of copyrighted assets.<br/>
Kindly contact either of the contributors of the project for the removal of any kind of asset one may feel, infringes their copyright(s).<br/>

## Usage and Software requirements
SNS is an open source repository and can be found [here](https://github.com/saanchi-gangwani/Stop-n-Shop). The project is not intended to be set live in the future and hence one needs to run it on their personal computers to view how it looks. Below are the steps to do the same:
* Clone the repository on your local machine from [here](https://github.com/saanchi-gangwani/Stop-n-Shop).
* Create a MySQL database of the name 'stop_n_shop' and import the file [sql/stop_n_shop.sql](sql/stop_n_shop.sql). This SQL file only has the structure of the database and not actual user data, however, it has data loaded for 'categories' and 'products' tables which can be used directly used as it is or changed as per one's requirements. Please remember to change the images under [imgs/](imgs/) folder as well if you change the data in these two tables.
* Use composer to include phpdotenv dependency to the project's config/composer folder.
* Create a .env file in config/ subfolder and use the [config/.env.example](config/.env.example) as an example to define all the environment variables required.
* Run the project using a PHP server on your localhost. (Apache is recommended)<br/>

## Developer Profiles
* [Devjyot Singh Sidhu](https://github.com/devoghub)
* [Saanchi Gangwani](https://github.com/saanchi-gangwani)<br/>

**NOTE: SNS is still an ongoing project and has certain features such as an admin panel, order history which have not yet been implemented or features like address management which are partially implemented. We, however, hope to finish this project ASAP with all these features live soon.**
