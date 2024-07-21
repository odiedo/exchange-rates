# Kalulu Exchange Rates

This project is a web application for calculating currency exchange rates, particularly for the Kalulu Enterprise. It includes functionalities for selecting currencies, exchange types, and rates, and it outputs the conversion result. Additionally, it integrates with Google Sheets API to log the transactions.
Results will be shown in the results setion after it has been saved in the google sheets.
The link for google-sheet that I used - https://docs.google.com/spreadsheets/d/1IYeqSp3deEAzwITgfCigESwYi9kORfUTeS7AT5ax0gc/edit?usp=share_link
![image](https://github.com/user-attachments/assets/f88016d7-7919-48b1-848f-64fc4d8dafd9)


## Features

- Displays exchange rates for buying and selling.
- Allows users to input an amount, select the currency, exchange type, and the desired conversion rate.
- Computes the conversion based on the selected parameters.
- Logs transactions to a Google Sheets document.

## Technologies Used

- **Frontend**: HTML, CSS, Bootstrap
- **Backend**: PHP, MySQL
- **API**: Google Sheets API
- **Libraries**: Google Client Library for PHP

## Setup and Installation

### Prerequisites

- PHP 7.x or higher
- MySQL
- Composer
- A Google Cloud project with Sheets API enabled
- A service account JSON file from Google Cloud

### Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/odiedo/exchange-rates.git
    cd exchange-rates
    ```

2. **Install dependencies:**

    ```bash
    composer install
    ```

3. **Set up the database:**

    - Create a MySQL database and import the necessary schema.
    - Update `include/conn.php` with your database credentials.

    ```php
    <?php 
        $servername = "your_server";
        $username = "your_username";
        $password = "your_password";
        $dbname = "your_database";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    ?>
    ```

4. **Set up Google Sheets API:**

    - Download the service account JSON file from your Google Cloud project.
    - Place it in the `include` directory and rename it to `google-cloud-file.json`.

5. **Run the application:**

    Place the project in your web server's root directory (e.g., `htdocs` for XAMPP) and navigate to `http://localhost/exchange-rates` in your web browser.
![image](https://github.com/user-attachments/assets/27749751-67e6-4acf-91b2-4cc4e0d2e4d4)

## Usage

1. Select the currency you want to convert from.
2. Enter the amount.
3. Select whether you are buying or selling.
4. Choose the target conversion rate (KES, UGX, or USD).
5. Click the "=" button to get the conversion result.
6. The result will be displayed on the screen and logged to Google Sheets.

## Contributing

Contributions are welcome! Please fork this repository and submit a pull request for any enhancements or bug fixes.


## Acknowledgements

- [Google API Client Library for PHP](https://github.com/googleapis/google-api-php-client)
- [Bootstrap](https://getbootstrap.com/)
- [Font Awesome](https://fontawesome.com/)
