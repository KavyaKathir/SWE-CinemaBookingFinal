const arrows = document.querySelectorAll('.arrow');
const movieLists = document.querySelectorAll('.movie-list');

arrows.forEach((arrow,i)=>{
    const itemNumber = movieLists[i].querySelectorAll("img").length;
    let clickCounter = 0;
    arrow.addEventListener("click",()=>{
        const ratio = parseInt(window.innerWidth / 270);
        clickCounter++;
    if(itemNumber - (4 + clickCounter) + (5 - ratio) >= 0){
        movieLists[i].style.transform = `translateX(${movieLists[i].computedStyleMap().get("transform")[0].x.value
        -300}px)`;
    } else {
        movieLists[i].style.transform = "translateX(0)";
        clickCounter = 0;
    };
    });
});
$(document).ready(function() {
    $(".navbar-toggler").click(function() {
        $("header").toggleClass("active");
    });
});
movieInput.addEventListener("keyup", enterCheck);
fAwesome.addEventListener('click', displaySearch);


const ball = document.querySelector('.toggle-ball');
const items = document.querySelectorAll('.container,.movie-list-title,.navbar-container,.sidebar,.left-menu-icon,.toggle,.arrow,.toggle-icon,.featured-desc,.profiles-pic,.profile-select,.search-container,.inputSearch input,.movie-chosen,#Error,.copyright');

let toggleChosen = JSON.parse(localStorage.getItem("modeSet"));
ball.addEventListener('click', ()=>{
    items.forEach(item=>{
        item.classList.toggle("active");
    });
    ball.classList.toggle("active");
    if (toggleChosen == 0){
        toggleChosen++;
        localStorage.setItem("modeSet", JSON.stringify(toggleChosen));
    } else {
        toggleChosen = 0;
        localStorage.setItem("modeSet", JSON.stringify(toggleChosen));
    };
});

function getData(searchItem) {
  const url = baseUrl + titleSearch + searchItem + joiner + urlKey
  fetch(url)
  .then(response => response.json())
  .then(resJson => resJson.Search.forEach(extractData))
  .catch(err => console.log('Invalid Search ',err))
}

function extractData({ Title, Year, Poster, Type, imdbID }) {

  if (Type === 'movie') {
    const url = 'https://www.imdb.com/title'+ "/" + imdbID
    const a = makeElementId('a')
    const div = makeElementId('div');
    const h1 = makeElementId('h1')
    const p = makeElementId('p')
    const img = makeElementId('img')

    div.setAttribute('class', "searchResultItem")

    h1.setAttribute('class', "title");
    h1.setAttribute('title', `Movie ${Title}`);
    h1.textContent =  Title
    div.appendChild(h1)

    p.setAttribute('class', "subtitle");
    p.setAttribute('title', "Year");
    p.textContent =  Year
    div.appendChild(p)

    a.setAttribute("target", "_blank")
    a.setAttribute('href', url)
    div.appendChild(a)

    img.setAttribute('src', `${Poster}`);
    img.setAttribute('alt', "Movie Poster Image");
    a.appendChild(img)

    app.appendChild(div)
  }
}

function enterCheck(e) {
  if (e.key === "Enter") {
    getData(e.target.value)
    clearValue()
    changeHero()
  }
}

function getSearchReq() {
  if(searchItem.value){
    getData(searchItem.value)
  }
}

function displaySearch() {
  movieInput.style.display = 'block'
  fAwesome.style.display = 'none'
}

function changeHero() {
  hero.style.height = '230px'
  heroBody.style.paddingTop = '7vh'
  return
}


function clearValue() {
  searchItem.value = ''
  app.innerHTML = ""
  return
}


function makeElementId(el) {
    return document.createElement(el)
}

movieInput.addEventListener("keyup", enterCheck)
fAwesome.addEventListener('click', displaySearch)
