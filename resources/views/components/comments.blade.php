<div class="comment" v-for="comment in comments">
    <div class="info-comment">
        <div>
            <span class="owner-comment">Marie Nathalie</span>
            <span class="date-comment">@{{ comment . date }}</span>
        </div>
        <div>
            <span class="note-comment">@{{ comment . note }}/5</span>
        </div>
    </div>
    <div class="contain-comment">@{{ comment . comment }}</div>
    <div>
        <a v-if="comment.flagged == 2">Commentaire approuvé</a>
        <a v-on:click="reportComment(comment.id)" v-bind:id="'reportButton'+comment.id" v-else="comment.flagged != 0"
            href="#">Signaler ce commentaire </a>
    </div>
</div>

<div class="pagination-comment">
    <button class="btn"
        v-on:click="commentLimit-=1;commentLimit<=1?commentLimit=1:commentLimit-=1;getStoreComments(selectedStore.id, commentLimit)">
        << </button>
            <button class="btn">@{{ commentLimit }}</button>
            <button class="btn"
                v-on:click="commentLimit+=1; commentLimit>=commentPages?commentLimit=commentPages:commentLimit+=1; getStoreComments(selectedStore.id, commentLimit)">>></button>
</div>
