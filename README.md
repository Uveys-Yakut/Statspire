# 🔐 Explanation

Statspire is a project designed to help you create statistics tables for top-langs and stats-card on GitHub. This project allows users to enhance their GitHub profiles and projects with visually appealing tables and charts.

 - ## Features

    - 📊 **Statistics Tables**: Create dynamic statistics tables for top-langs and stats-card.

    - 🎨 **Theme Support**: Personalize your tables and charts with a variety of themes:

      - dark_blue
      - dark
      - purple
      - orange
      - green
      - cool
      - dracula
    
    - 📈 **Chart Types**: Various types are available for the graphs in the top-langs table:

      - pie
      - pie_v
      - donut
      - donut_v
      - compress
      - hide

- ## 🚀 Installation

    To get started with Statspire, follow these steps:
    
    1. **Clone the Repository**:
    
       
       ```bash
       git clone https://github.com/your_username/statspire.git
       cd statspire
       ````
       
    2. **Install Composer Dependencies**:  Make sure you have Composer installed, then run:
    
       ```bash
        composer install
       ````

    3. **Set Up Environment**: Copy the .env.example file to .env:
    
       
       ```bash
       cp .env.example .env
       ````

       Generate an application key:

       ```bash 
       cp .env.example .env
       ````

    4. **Start the Development Server**: You can start the Laravel development server with:
    
       ```bash
       php artisan serve
       ````
- ## 🧰 Usage

    Statspire's usage is based on URL parameters. You can customize the statistics tables and charts by appending the following parameters to the URL:

    - ### URL for Top-Langs

       To create a top-langs table, use the following format:
       ```bash
        http://localhost:8000/api/v1/top-langs?username={username}&chart_type={chart_type}&theme={theme}
       ````

       - __username__: GitHub Username.
       - __chart_type__: The chart type to use for the table. (e.g., donut)
       - __theme__: Theme for the table. (e.g., orange)
       
      ### 💡 Example:
       ```markdown
      ![Top Langs](http://localhost:8000/api/v1/top-langs?username=anuraghazra&chart_type=donut&theme=orange)
      ````

    - ### URL for Stats-Card
       ```markdown 
        http://localhost:8000/api/v1/stats-card?username={username}&theme={theme}&show_icons={true}
       ````

       ```markdown
       http://localhost:8000/api/v1/stats-card?username={username}&theme={theme}&hide=[id1,id2,...]
       ````

       ```markdown
       http://localhost:8000/api/v1/stats-card?username={username}&theme={theme}&hide=full
       ````

       - __username__: GitHub Username.
       - __theme__: Theme for the table. (e.g., orange)
       - __show_icons__: Choose whether to display icons.
       - __hide__: The array to be used to determine the data to be hidden. For example: [4,5] or full to hide all data..

       ### 💡 Example:
       ```markdown
       ![Stats Card 1](http://localhost:8000/api/v1/stats-card?username=anuraghazra&theme=orange&show_icons=true)

       ![Stats Card 2](http://localhost:8000/api/v1/stats-card?username=anuraghazra&theme=orange&hide=[4,5])
        
       ![Stats Card 3](http://localhost:8000/api/v1/stats-card?username=anuraghazra&theme=orange&hide=full)
       ````

- ## 💡 Example Stats

    - ### Top-Langs Table

      The following example shows a top-langs table created with the orange theme and donut chart type:
      ![Example Stats Card](/public/assets/img/example/top_langs.svg)

    - ### Stats-Card Examples

      Here are examples of `stats-card` with specified options:
      ![Stats Card](/public/assets/img/example/stats_card.svg)
      ![Stats Card Hide Chart](/public/assets/img/example/stats_card_hide.svg)

## 📸 Screenshots

![Stats Card](/public/assets/img/stats_card.png)
![Top Languages](/public/assets/img/top_langs.png)
![Top Languages Chart Type Vertical](/public/assets/img/top_langs_chart_type_v.png)

## 📜 License

This project is licensed under the [MIT License](LICENSE)

## 👥 Contributors

Contributions are welcome! If you want to contribute to the project, please feel free to submit a pull request.

## 📬 Contact

For questions and feedback, you can reach me via email: uveysyakut859188@protonmail.com
