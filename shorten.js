const shortenBtn = document.getElementById("shorten-btn");
const inputUrl = document.getElementById("input-url");
const outputUrl = document.getElementById("output-url");

shortenBtn.addEventListener("click", function() {
  // Get the input URL
  const url = inputUrl.value;

  // Shorten the URL
  fetch('urlShortener.php', {
    method: 'post',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `longUrl=${encodeURIComponent(url)}`
  })
  .then(response => response.json())
  .then(data => {
    // Update the output URL
    const shortUrl = data.shortUrl;
    outputUrl.value = shortUrl;

    // Write to the urls.txt file
    fetch('urlShortener.php', {
      method: 'post',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `longUrl=${encodeURIComponent(url)}&shortUrl=${encodeURIComponent(shortUrl)}`
    });
  });
});

