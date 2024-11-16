<div style="
border-radius: 5px; 
border: 2px solid black;
margin: 1rem; 
background:aqua;
height: 10rem;"
>
    <span style="margin-left: 0.5rem;">
        <span>
            <b>{{'@' . $username}}</b>
        </span>
        <span style="margin-left: 1rem">
            {{$date}}
        </span>
    </span>
    
    <p><b>{{$title}}</b></p>
    <p style="margin-left: 0.5rem; margin-right: 0.5rem">{{$slot}}</p>

    <button style="
        border-radius: 5px;
        background: lightgrey;
        margin:0.5rem;
        margin-right:0.25rem;
        padding:0.5rem;
    ">
        <span><b>Likes:</b></span>
        {{$likes}}
    </button>

    <button style="
        border-radius: 5px;
        background: lightgrey;
        margin:0.5rem;
        margin-left: 0.25rem;
        padding:0.5rem;
    ">
        <span><b>Dislikes:</b></span>
        {{$dislikes}}
</button>

</div>