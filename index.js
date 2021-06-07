let map;
let centerLatLng={lat:43.2557,lng:-79.8711};
let userLocation;
let songs=[];
let markers=[];
let insertId;
let playing=false;
let songTitle;
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center:{
            lat:43.2557,
            lng:-79.7811
        },
        fullscreenControl:false,
        mapTypeControl:false
    });
    detectUserLocation();
    getSongs();
}

gapi.load("client", loadClient);
function loadClient() {
    gapi.client.setApiKey("API_KEY");
    return gapi.client.load("https://www.googleapis.com/discovery/v1/apis/youtube/v3/rest")
        .then(function() { console.log("GAPI client loaded for API"); },
                function(err) { console.error("Error loading GAPI client for API", err); });
}

function detectUserLocation(){
    if(navigator.geolocation){
        navigator.geolocation.getCurrentPosition(
            (position)=>{
                const pos={
                    lat:position.coords.latitude,
                    lng:position.coords.longitude,
                };
                userLocation=pos;
                
                
                map.setCenter(userLocation);
            }
        )
    }
}





function getSongs(){
    let url="songs.php";
    fetch(url,{credentials:"include"})
        .then(response => response.json())
            .then(getSongsSuccess)

}
function getSongsSuccess(songsResult){
    // let marker;
    songs=songsResult;
    setMarkers();
}
function setMarkers(){
    let marker;
    let filteredSongs;
    clearMarkers();
    let filter=$("#filter").val();
    if(filter!==""){
        filteredSongs=songs.filter((val,idx,array)=>{
            return val.song_name.toLowerCase().includes(filter);
        }
        );
    }
    if(filter===""){
        filteredSongs=songs;
    }
    filteredSongs.forEach(song => {
        let latLng={lat:Number(song.lat),lng:Number(song.lng)};
        insertId=song.id+1;
        marker= new google.maps.Marker({
            position:latLng,
            map:map,
            icon: "play-marker-icon.svg",
            title: song.song_name+"",
        });
        google.maps.event.addListener(marker,'click',function(){
            createAudio(song.song_id);
            $("#song-title").text("Playing: "+song.song_name);
            
            $("#message").text("");
        });

        markers.push(marker);
    });;
    
}
function clearMarkers(){
    markers.forEach((marker,idx,array)=>{
        marker.setMap(null);
    });
}
function createAudio(songId){
    $("#youtube iframe").remove();
    
    $('<iframe width="420" height="315" frameborder="0" allow="autoplay"></iframe>')
    .attr("src", "https://www.youtube.com/embed/" + songId+"?autoplay=1&enablejsapi=1")
    .appendTo("#youtube");
    $("#play-button").css("display","none");
    $("#pause-button").css("display","block");
}

$("#play-button").click(function(){
    $('#youtube iframe').each(function(){
        this.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*')
      });
    $("#play-button").css("display","none");
    $("#pause-button").css("display","block");

});
$("#pause-button").click(function(){
    $('#youtube iframe').each(function(){
        this.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*')
      });
    $("#play-button").css("display","block");
    $("#pause-button").css("display","none");
    
});

$("#add-button").click(function (){
    if($("#song-name").val()!==""&&$("#song-artist").val()!==""){
        getSongId();
        
    }
    else{
        $("#message").text("Fields Cannot Be Empty");
    }
});



function getSongId(){
    let name=$("#song-name").val();
    let artist=$("#song-artist").val();
    let lat=userLocation.lat;
    let lng=userLocation.lng;
    let songId;
    var arr_search={
        "part":'snippet',
        "maxResults":1,
        "q":name+" "+artist
    }
    return gapi.client.youtube.search.list(arr_search)
    .then(function(response){
        const searchResult=response.result.items[0];
        if(searchResult){
            songId=searchResult.id.videoId;
            name=searchResult.snippet.title;
            add(name,artist,lat,lng,songId);
        }
        else{
            $("#message").text("Video/Song does not exist on youtube, choose another");
        }
    }

    )
}
$("#filter").on("input",function(){
    setMarkers();
});
function add(name,artist,lat,lng,songId){
    let url="add-edit.php?id="+insertId+"&lat="+lat+"&lng="+lng+"&name="+name+"&artist="+artist+"&songId="+songId;

    fetch(url,{credentials:'include'})
        .then(response=>response.text())
        .then(addSuccess)
}
function addSuccess(message){

    $("#message").text(message);
    get();
}

$("#delete-button").click(function(){
    let lat=userLocation.lat;
    let lng=userLocation.lng;
    let url="delete.php?lat="+lat+"&lng="+lng;
    

    fetch(url,{credentials:'include'})
    .then(response=>response.text())
    .then(deleteSuccess)
});
function deleteSuccess(message){
    

    $("#message").text(message);
    get();
}