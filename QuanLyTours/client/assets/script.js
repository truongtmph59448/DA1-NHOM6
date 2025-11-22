document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('search-form');
    if (searchForm) {
        searchForm.addEventListener('submit', function(event) {
            event.preventDefault(); 
            
            const destination = document.getElementById('destination').value;
            const date = document.getElementById('date').value;
            const tourType = document.getElementById('tour-type').value;

            console.log('--- ĐANG TÌM KIẾM (Bootstrap) ---');
            console.log('Điểm đến:', destination);
            console.log('Ngày đi:', date);
            console.log('Loại tour:', tourType);

            alert('Đang tìm kiếm tour, vui lòng kiểm tra Console (F12)!');
        });
    }
});