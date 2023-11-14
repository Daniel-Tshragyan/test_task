$(document).ready(function() {
    $('.getUsers').click(function() {
        const csrf = $('input[name="_token"]').val()

        fetch('/import-users', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrf,
                'Content-Type': 'application/json',
            }
        })
            .then(response => response.json())
            .then(data => {
               console.log(data)
                $('#userCount').text(data.all)
                $('#userAddedCount').text(data.created)
                $('#userUpdatedCount').text(data.updated)
            })
            .catch(error => {
                // Handle any errors
            });
    })
})
