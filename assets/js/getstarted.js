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
/**
function unhide(divID1, divID2) {
	var item = document.getElementById(divID1);
	var item2 = document.getElementById(divID2)
	if (item.className=='hidden' || item2.className=='unhidden') {
        item.className=unhidden;
				item2.className=hidden;
    }
}
item.className=(item.className=='hidden')?'unhidden':'hidden';

function unhide(divID) {
	var item = document.getElementById(divID);
	if (item) {
        item.className=(item.className=='hidden')?'unhidden':'hidden';
    }
}

 **/
 function unhide(divID) {
 	var item = document.getElementById(divID);
 	if (item) {
         item.className=(item.className=='hidden')?'unhidden':'hidden';
     }
	else {
		return false;
	}
 }
 function tago(divID) {
 	var item = document.getElementById(divID);
 	if (item) {
         item.className=(item.className=='unhidden')?'hidden':'hidden';
     }
		else {
			return false;
		}
 }
