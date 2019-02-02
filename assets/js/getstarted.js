const left = document.querySelector('.left');
const right = document.querySelector('.right');
const container = document.querySelector('.container-fluid');
const contain = document.querySelector('.placeholder');
const contai = document.querySelector('.placeholder2');
const west = document.querySelector('#trigger-a');
const east = document.querySelector('#trigger-b');
left.addEventListener('click', () =>{
	container.classList.add('hover-left');
	if (contain.classList.contains('hidden')) {
		contain.classList.remove('hidden');
	}
});
left.addEventListener('mouseleave', () =>{
	container.classList.remove('hover-left');
});
right.addEventListener('click', () =>{
	container.classList.add('hover-right');
	if (contai.classList.contains('hidden')) {
		contai.classList.remove('hidden');
	}
});
right.addEventListener('mouseleave', () =>{
	container.classList.remove('hover-right');
});
west.addEventListener('mouseleave', () =>{
	contain.classList.add('hidden');
});
east.addEventListener('mouseleave', () =>{
	contai.classList.add('hidden');
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
