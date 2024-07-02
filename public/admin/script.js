// $(document).ready(function() {
//     setInterval(function() {
//         axios.get('http://laravel.loc/notice-board/index')
//             .then(function(response) {
//                 const stories = response.data;
//                 let tableBody = $('#story-table-body');
//                 tableBody.empty();
//                 stories.forEach(function(story) {
//                     let row = `<tr>
//                     <td>${story.title}</td>
//                     <td>${story.description}</td>
//                 </tr>`;
//                     tableBody.append(row);
//                 });
//             })
//             .catch(function(error) {
//                 console.error('Error fetching data:', error);
//             });
//     }, 500);
// });

// $(document).ready(function() {
//     window.Echo.channel('approve-channel')
//         .listen('.approve-event',  res => {
//             console.log(res);
//         })
// })


// Pusher.logToConsole = true;

// let pusher = new Pusher('842c125709eed6ebfabb', {
//     cluster: 'ap2'
// });
//
// let channel = pusher.subscribe('approve-channel');
// channel.bind('approve-event', function(data) {
//     console.log(data);
// });
