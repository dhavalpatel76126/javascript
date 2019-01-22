
var myresultdiv = document.getElementById("myresultdiv");
var request = new XMLHttpRequest();
request.open('GET', 'https://api.themoviedb.org/3/movie/popular?page=1&language=en-US&api_key=2858f484f1d0a7fc44f73045315bfc02', true);
request.onload = function () {
  path = "http://image.tmdb.org/t/p/w200//";
  var data = JSON.parse(this.response);
  
  
  if (request.status >= 200 && request.status < 400) {
    for (let index = 0; index < data.results.length; index++) {
     
      var element = data.results[index];
      path1 = "http://image.tmdb.org/t/p/w200//"+element.poster_path;
      console.log(path);
      var cln = document.getElementById("myclonediv").cloneNode(true);
      cln.id = myclonediv.id + index;
      var movieName = cln.querySelector(".movieName");
      var moviePoster = cln.querySelector(".movieposter");
      var movieOverview = cln.querySelector(".overview");
      var movieDate = cln.querySelector(".releaseDate");
      var view_more = cln.querySelector(".viewMore");
      view_more.alt = movieName;
      moviePoster.src=path1;
      movieName.innerHTML = element.original_title;
      movieOverview.innerHTML=  element.overview;
      movieDate.innerHTML = element.release_date;
      myresultdiv.appendChild(cln);      
    }
    
   }
  

}
request.send();
