const styles: Record<string, string> = {
    "First Style": "styles/page1.css",
    "Second Style": "styles/page2.css",
    "Third Style": "styles/page3.css"
};


function changeStyle(styleName: string): void {
    const head = document.head;
    const existingLink = document.querySelector('link[rel="stylesheet"]');

    if (existingLink) {
        head.removeChild(existingLink); 
    }

    const link = document.createElement('link');
    link.rel = "stylesheet";
    link.href = styles[styleName];
    head.appendChild(link); 

    
    localStorage.setItem('selectedStyle', styleName);
}


function createStyleLinks(): void {
    const dynamicLinks = document.querySelector('#dynamic-links');
    if (!dynamicLinks) return;

    dynamicLinks.innerHTML = ''; 

    for (const styleName in styles) {
        const li = document.createElement('li');
        const button = document.createElement('button');
        button.textContent = styleName;
        button.onclick = () => changeStyle(styleName);
        li.appendChild(button);
        dynamicLinks.appendChild(li);
    }
}

// Восстанавливаем стиль из localStorage или применяем стиль по умолчанию
function restoreStyle(): void {
    const savedStyle = localStorage.getItem('selectedStyle');
    const styleToApply = savedStyle && styles[savedStyle] ? savedStyle : Object.keys(styles)[0];
    changeStyle(styleToApply);
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    restoreStyle(); // Восстанавливаем стиль
    createStyleLinks(); // Генерируем ссылки для смены стилей
});
