document.addEventListener('DOMContentLoaded', function () {
  const pricePageField = document.querySelector(
    '[name="price_page' + currentLanguage() + '"]'
  );
  const updateTimeField = document.querySelector(
    '[name="price_page_update_time' + currentLanguage() + '"]'
  );

  if (pricePageField && updateTimeField) {
    pricePageField.addEventListener('input', function () {
      const now = new Date();
      const formattedTime = `${now.getHours()}:${('0' + now.getMinutes()).slice(
        -2
      )} ${now.getDate()}/${('0' + (now.getMonth() + 1)).slice(
        -2
      )}/${now.getFullYear()}`;
      updateTimeField.value = formattedTime;
    });
  }
});
