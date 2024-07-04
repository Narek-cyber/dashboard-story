$(document).ready(function() {
    setInterval(function() {
        axios.get('http://laravel.loc/notice-boards/index')
            .then(function(response) {
                const stories = response.data;
                let tableBody = $('#story-table-body');
                tableBody.empty();
                stories.forEach(function(story) {
                    let row = `<tr>
                    <td>${story.title}</td>
                    <td>${story.description}</td>
                </tr>`;
                    tableBody.append(row);
                });
            })
            .catch(function(error) {
                console.error('Error fetching data:', error);
            });
    }, 500);
});
