<div class="card" v-for="comment in comments">
    <h2 class="card-title">@{{ comment.note }} / 10</h2>
    <p>@{{ comment.date }}</p>
    <p>@{{ comment.comment }}</p>
    <a v-if="comment.flagged == 2"
       href="#">Commentaire approuvé
    </a>
    <a v-on:click="reportComment(comment.id)"
       v-bind:id="'reportButton'+comment.id"
       v-else="comment.flagged != 0"
       href="#">Signaler ce commentaire
    </a>
</div>
<button class="btn btn-square" v-on:click="commentLimit-=1;commentLimit<=1?commentLimit=1:commentLimit-=1;getStoreComments(storeSelected.id, commentLimit)"><</button>
<button class="btn btn-square btn-primary">@{{ commentLimit }}</button>
<button class="btn btn-square" v-on:click="commentLimit+=1;commentLimit>=commentPages?commentLimit=commentPages:commentLimit+=1;getStoreComments(storeSelected.id, commentLimit)">></button>
