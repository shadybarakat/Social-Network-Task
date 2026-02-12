import axios from 'axios';

document.addEventListener('click', function (e) {

    // LIKE
    if (e.target.closest('.like-btn')) {
        e.preventDefault();

        let btn = e.target.closest('.like-btn');
        let url = btn.dataset.url;
        let count = btn.querySelector('.like-count');

        axios.post(url).then(res => {
            count.textContent = res.data.likes_count;
            btn.classList.toggle('liked', res.data.liked);
        });
    }

    // ADD FRIEND
    if (e.target.closest('.add-friend-btn')) {
        e.preventDefault();

        let btn = e.target.closest('.add-friend-btn');
        axios.post(btn.dataset.url).then(() => {
            btn.textContent = 'Request Sent';
            btn.disabled = true;
            btn.classList.add('opacity-60');
        });
    }

    // ACCEPT FRIEND
    if (e.target.closest('.accept-friend-btn')) {
        e.preventDefault();

        let btn = e.target.closest('.accept-friend-btn');
        axios.post(btn.dataset.url).then(() => {
            btn.textContent = 'Friends';
            btn.disabled = true;
            btn.classList.add('opacity-60');
        });
    }

});
