const axios = require('axios');
const cron = require('node-cron');
const mysql = require('mysql2'); // MySQL client
const nodemailer = require('nodemailer'); // For sending emails
const moment = require('moment-timezone'); // Import moment-timezone

// Set up the MySQL/MariaDB client
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'aquasensedb',
});

connection.connect((err) => {
    if (err) {
        console.error('Error connecting to the database:', err.stack);
        return;
    }
    console.log('Connected to the MySQL database');
});

// Set the ESP32 URL
const esp32Url = 'http://192.168.5.143/sensor_data';

// Set up nodemailer transport
const transporter = nodemailer.createTransport({
    service: 'gmail', // Use your email service provider
    auth: {
        user: '4quas3nse@gmail.com', // Replace with your email
        pass: 'ontariqamuplakdu', // Replace with your email password or app password
    },
});

// Function to send email
async function sendEmail(subject, message) {
    try {
        await transporter.sendMail({
            from: '"AquaSense Alert" <4quas3nse@gmail.com>',
            to: 'uriels.evangelista@gmail.com', // Replace with the recipient email
            subject: subject,
            text: message,
        });
        console.log('Notification email sent.');
    } catch (error) {
        console.error('Error sending email:', error.message);
    }
}

// Function to fetch sensor data from ESP32
async function fetchSensorData() {
    try {
        const response = await axios.get(esp32Url);
        // Extract sensor values
        const ph = data.ph_level || '--';
        const temperature = parseFloat(data.temperature) || '--';
        const ammonia = data.ammonia_level || '--';
        const doLevel = data.do_level || '--';

        // Get the current timestamp in Manila time (UTC+8)
        const timestamp = moment().tz("Asia/Manila").format("YYYY-MM-DD HH:mm:ss");

        // Check temperature range and send email if out of range
        if (temperature !== '--' && (temperature < 25 || temperature > 30)) {
            const subject = 'AquaSense Temperature Alert';
            const message = `Warning: Water temperature is out of range!\n\nCurrent Temperature: ${temperature}°C\nTimestamp: ${timestamp}`;
            await sendEmail(subject, message);
        }

        if (ph !== '--' && (ph < 25 || ph > 30)) {
            const subject = 'AquaSense PH Alert';
            const message = `Warning: Water PH is out of range!\n\nCurrent Temperature: ${ph}°C\nTimestamp: ${timestamp}`;
            await sendEmail(subject, message);
        }

        if (ammonia !== '--' && (ammonia < 25 || ammonia > 30)) {
            const subject = 'AquaSense Ammonia Alert';
            const message = `Warning: Water Ammonia is out of range!\n\nCurrent Temperature: ${ammonia}°C\nTimestamp: ${timestamp}`;
            await sendEmail(subject, message);
        }

        if (doLevel !== '--' && (   doLevel < 25 || doLevel > 30)) {
            const subject = 'AquaSense Ammonia Alert';
            const message = `Warning: Water Ammonia is out of range!\n\nCurrent Temperature: ${doLevel}°C\nTimestamp: ${timestamp}`;
            await sendEmail(subject, message);
        }

        if (response.status === 200) {
            const data = response.data;
            // Insert data into the database
            const query = `
                INSERT INTO sensor_data (ph_level, temperature, ammonia_level, do_level, last_saved)
                VALUES (?, ?, ?, ?, ?)
            `;
            connection.execute(query, [ph, temperature, ammonia, doLevel, timestamp], (err, results) => {
                if (err) {
                    console.error('Error inserting data into the database:', err.message);
                    return;
                }
                console.log('Data inserted successfully:', { ph, temperature, ammonia, doLevel, timestamp });
            });
        } else {
            console.log(`Failed to fetch data: HTTP ${response.status}`);
        }
    } catch (error) {
        console.error('Error fetching data:', error.message);
    }
}

// Schedule the task to run every 5 minutes
cron.schedule('*/1 * * * * *', fetchSensorData);

