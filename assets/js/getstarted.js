const left = document.querySelector('.left');
const right = document.querySelector('.right');
const container = document.querySelector('.container-fluid');

left.addEventListener('click', () =>{
	container.classList.add('hover-left');
});

left.addEventListener('mouseleave', () =>{
	container.classList.remove('hover-left');
});

right.addEventListener('click', () =>{
	container.classList.add('hover-right');
});

right.addEventListener('mouseleave', () =>{
	container.classList.remove('hover-right');
});
switch_b.addEventListener('mouseleave', () =>{
	container.classList.add('switch-left');
});

function unhide(divID) {
	var item = document.getElementById(divID);
	if (item) {
        item.className=(item.className=='hidden')?'unhidden':'hidden';
    }
}
