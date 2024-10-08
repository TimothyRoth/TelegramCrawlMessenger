# TelegramCrawlMessenger

TelegramCrawlMessenger is a tool designed to help you set up a Telegram bot, integrate it into a group chat, and enable it to crawl messages based on defined endpoints and markup.

## Getting Started

### 1. Set Up Your Telegram Bot

To get started, you'll need to create a Telegram bot, add it to your group with the necessary permissions, and set up a cron job to run the bot periodically.

#### Steps:

1. **Create a Bot:**
   - Go to Telegram and search for the `@BotFather`.
   - Use the `/newbot` command to create a new bot.
   - Follow the instructions to give your bot a name and username.
   - Once created, you'll receive a token. **Keep this token safe**, as you'll need it to interact with the Telegram API.

2. **Get Your Chat ID:**
   - Start a conversation with your bot or add it to a group.
   - Use the following API call to get the chat ID:
     ```bash
     https://api.telegram.org/bot<your-bot-token>/getUpdates
     ```
   - Send a message in the group or chat where the bot is present. The `getUpdates` API call will return a JSON object containing the `chat_id`.

3. **Add the Bot to Your Group:**
   - Add the bot to your desired group.
   - Grant it the necessary permissions, especially the ability to send messages, read messages, and interact with other group members.

### 2. Set Up a Cron Job

To keep your bot running continuously and performing its tasks at regular intervals, you'll need to set up a cron job to execute the `cron.php` script.

#### Steps:

1. **Edit Your Crontab:**
   - Open your crontab file for editing by running:
     ```bash
     crontab -e
     ```

2. **Add a Cron Job:**
   - Add a new line to schedule the `cron.php` script to run at regular intervals. For example, to run the script every 5 minutes, add:
     ```bash
     */5 * * * * /usr/bin/php /path/to/your/project/cron.php
     ```
   - Make sure to replace `/path/to/your/project/cron.php` with the actual path to your `cron.php` file.

3. **Save and Exit:**
   - Save the crontab file and exit the editor. The cron job is now set up and will execute `cron.php` at the specified intervals.

### 3. How to Use

To use TelegramCrawlMessenger, you'll need to define some constants and modify the necessary endpoints and markup in the code.

#### Steps:

1. **Define Constants:**
   - Open the project and locate the section where constants are defined (usually in a `config.php`).
   - Define your Telegram bot token and the chat ID:
     ```php
     define('TB_BOT_TOKEN', 'your-telegram-bot-token');
     define('TB_CHAT_ID', 'your-chat-id');
     ```

2. **Modify Endpoints:**
   - Navigate to the code section where API endpoints are defined.
   - Modify the endpoints according to your needs. This might include the URL, parameters, and any required headers.

3. **Set Up Markup for Crawling:**
   - If your bot is intended to crawl and parse messages, define the markup or patterns it should look for in incoming messages.
   - This may include regular expressions or other parsing logic defined within the code.

4. **Run the Bot Manually (Optional):**
   - If you want to run the bot manually, you can do so by executing the `cron.php` file:
     ```bash
     php /path/to/your/project/cron.php
     ```

5. **Read the Documentation:**
   - Be sure to read through the comments and documentation within the code itself. This will provide more detailed guidance on how to customize and extend the bot's functionality.
