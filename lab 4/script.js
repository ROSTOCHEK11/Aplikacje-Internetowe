document.getElementById('get-weather-btn').addEventListener('click', () => {
    const city = document.getElementById('city-input').value.trim();
    if (!city) {
        alert('Please enter a city name');
        return;
    }

    const apiKey = '2927defe507a75b040c055811b4e49a8'; // Replace with your actual API key
    const currentWeatherUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;
    const forecastUrl = `https://api.openweathermap.org/data/2.5/forecast?q=${city}&appid=${apiKey}&units=metric`;

    
    const xhr = new XMLHttpRequest();
    xhr.open('GET', currentWeatherUrl);
    xhr.onload = function () {
        if (xhr.status === 200) {
            const currentWeather = JSON.parse(xhr.responseText);
            console.log('Current Weather Data:', currentWeather); 
            displayCurrentWeather(currentWeather);
        } else {
            console.error('Error fetching current weather data:', xhr.responseText);
            alert('Error fetching current weather data');
        }
    };
    xhr.send();

    
    fetch(forecastUrl)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error fetching forecast data: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Forecast Data:', data); 
            displayForecast(data);
        })
        .catch(error => console.error(error));
});

function displayCurrentWeather(data) {
    const weatherResult = document.getElementById('weather-result');
    let currentWeatherHtml = `
        <div id="current-weather">
            <h3>Current Weather</h3>
            <div class="forecast-item">
                <div>${data.name}</div>
                <div>${data.main.temp}°C</div>
                <div class="temp-column">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="down-arrow" viewBox="0 0 24 24">
                            <path d="M12 2v14M7 12l5 5 5-5z"/> <!-- Стрелка вниз -->
                        </svg>
                        ${data.main.temp_min}°C
                    </span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="up-arrow" viewBox="0 0 24 24">
                            <path d="M12 22V8M7 10l5-5 5 5z"/> <!-- Стрелка вверх -->
                        </svg>
                        ${data.main.temp_max}°C
                    </span>
                </div>
                <div class="weather-description">
                    <img src="https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png" alt="${data.weather[0].description}">
                    <span>${data.weather[0].description}</span>
                </div>
            </div>
        </div>
    `;
    weatherResult.innerHTML += currentWeatherHtml;
}

function displayForecast(data) {
    const weatherResult = document.getElementById('weather-result');
    let forecastHtml = `
        <div id="forecast-container">
            <h3>5-Day Forecast</h3>
    `;
    data.list.forEach((item, index) => {
        if (index % 8 === 0) { // Show one forecast per day
            forecastHtml += `
                <div class="forecast-item">
                    <div>${item.dt_txt.split(' ')[0]}</div>
                    <div>${item.main.temp}°C</div>
                    <div class="temp-column">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="down-arrow" viewBox="0 0 24 24">
                                <path d="M12 2v14M7 12l5 5 5-5z"/> <!-- Стрелка вниз -->
                            </svg>
                            ${item.main.temp_min}°C
                        </span>
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="up-arrow" viewBox="0 0 24 24">
                                <path d="M12 22V8M7 10l5-5 5 5z"/> <!-- Стрелка вверх -->
                            </svg>
                            ${item.main.temp_max}°C
                        </span>
                    </div>
                    <div class="weather-description">
                        <img src="https://openweathermap.org/img/wn/${item.weather[0].icon}@2x.png" alt="${item.weather[0].description}">
                        <span>${item.weather[0].description}</span>
                    </div>
                </div>
            `;
        }
    });
    forecastHtml += `</div>`;
    weatherResult.innerHTML += forecastHtml;
}

