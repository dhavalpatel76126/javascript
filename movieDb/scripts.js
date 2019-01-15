const app = document.getElementById('root');

const logo = document.createElement('img');


const container = document.createElement('div');
container.setAttribute('class', 'container');

app.appendChild(logo);
app.appendChild(container);

var request = new XMLHttpRequest();
request.open('GET', 'https://api.themoviedb.org/3/movie/popular?page=1&language=en-US&api_key=2858f484f1d0a7fc44f73045315bfc02', true);
request.onload = function () {
path="http://image.tmdb.org/t/p/w200//";
  var data = JSON.parse(this.response);
 // console.log(data.poster_path);
  if (request.status >= 200 && request.status < 400) {
    data.results.forEach(movie => {
      const card = document.createElement('div');
      card.setAttribute('class', 'card');
      const h1 = document.createElement('h3');
      var x = document.createElement("img");
      x.setAttribute("src", path+movie.poster_path);
      x.setAttribute("width", "200");
      x.setAttribute("height", "200");
      x.setAttribute("alt", "The Pulpit Rock");
      h1.textContent = movie.title;
      var y= document.createElement('span');
      y.textContent=movie.overview;
      container.appendChild(card);
      card.appendChild(h1);
      card.append(x);
      card.append(y);
    });
  } 
}

request.send();
