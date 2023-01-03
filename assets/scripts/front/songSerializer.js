'use strict'
// import 'aplayer/dist/APlayer.min.css';
// import APlayer from 'aplayer';
//
//
// const ap = new APlayer({
//     container: document.getElementById('aplayer'),
//     audio: [
//         {
//             name: 'name',
//             artist: 'artist plop',
//             url: '/mp3/03-John-Lopker-Hijab-Drones-Iran-Ukraine-Freedom-63b3fc7222176-mp3',
//             cover: 'cover.jpg',
//         }
//     ]
// });


const album = document.querySelector('#album-content');
console.log(album)


//
// const player = document.getElementById('player');
// const playButton = document.getElementById('play');
// const previousButton = document.getElementById('previous');
// const nextButton = document.getElementById('next');
//
//
//
// const songs = document.querySelector('#album-content');
// console.log(songs)
// let currentSong = 0;
//
// playButton.addEventListener('click', () => {
//     player.play();
// });
//
// previousButton.addEventListener('click', () => {
//     currentSong = (currentSong - 1 + songs.length) % songs.length;
//     player.src = songs[currentSong];
//     player.play();
// });
//
// nextButton.addEventListener('click', () => {
//     currentSong = (currentSong + 1) % songs.length;
//     player.src = songs[currentSong];
//     player.play();
// });
//
// player.addEventListener('ended', () => {
//     currentSong = (currentSong + 1) % songs.length;
//     player.src = songs[currentSong];
//     player.play();
// });