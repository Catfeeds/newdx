function P7_equalCols(e1,e2)
{
	e1=document.getElementById(e1);
	e2=document.getElementById(e2);
	if (e1.offsetHeight>e2.offsetHeight)
	{e2.style.height=e1.offsetHeight + 'px';}
	e1.style.height = e2.offsetHeight + 'px';
}