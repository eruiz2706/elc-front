
<div v-if='view_resp_unica'>
@include('backend.modulos.preguntas.partials.respuestas.unica')
</div>

<div v-if='view_resp_multiple'>
@include('backend.modulos.preguntas.partials.respuestas.multiple')
</div>

<div v-if='view_resp_relacionar'>
@include('backend.modulos.preguntas.partials.respuestas.relacionar')
</div>
