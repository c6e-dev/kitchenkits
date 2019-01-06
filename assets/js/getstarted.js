const left = document.querySelector('.left');
const right = document.querySelector('.right');
const container = document.querySelector('.container-fluid');

left.addEventListener('mouseenter', () =>{
	container.classList.add('hover-left');
});

left.addEventListener('mouseleave', () =>{
	container.classList.remove('hover-left');
});

right.addEventListener('mouseenter', () =>{
	container.classList.add('hover-right');
});

right.addEventListener('mouseleave', () =>{
	container.classList.remove('hover-right');
});

function unhide(divID) {
	var item = document.getElementById(divID);
	if (item) {
        item.className=(item.className=='hidden')?'unhidden':'hidden';
    }
}
