<div style="
border-radius: 5px; 
border: 2px solid black;
margin: 1rem; 
background:aqua;
height: 10rem;"
>
    <p><b>{{'@' . $username}}</b></p>
    <p>{{$slot}}</p>
    <span><b>Likes:</b></span>
    <span>{{$likes}}</span>
    <span><b>Dislikes:</b></span>
    <span>{{$dislikes}}</span>
</div>