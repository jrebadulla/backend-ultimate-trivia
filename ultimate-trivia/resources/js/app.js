import './bootstrap';

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

axios.post('/profile', {
    data: yourData
})
.then(response => {
    console.log('Success:', response.data);
})
.catch(error => {
    console.error('Error:', error);
});
