var data = "{}";

var xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener("readystatechange", function () {
  if (this.readyState === this.DONE) {
    console.log(this.responseText+"<br>");
  }
});

xhr.open("GET", "https://api.themoviedb.org/3/movie/100?language=en-US&api_key=2858f484f1d0a7fc44f73045315bfc02");

xhr.send(data);