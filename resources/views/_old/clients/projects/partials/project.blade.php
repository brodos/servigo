<div class="d-flex justify-content-center align-items-center p-4 border-bottom bg-light text-black-50">
    		<h2 class="flex-fill mb-0">Detalii proiect</h2>

    		<div class="flex-fill text-right align-self-start">
    			
    			{!! $project->status === 1 ? '<span class="px-2 py-1 badge badge-secondary">DRAFT</span>' : '<span class="px-2 py-1 badge badge-success">ACTIVE</span>' !!}

    		</div>
    	</div>

		<div class="project-content p-5">

            <div class="project-section pb-5">

                <p class="font-weight-bold">Descriere:</p>

    			<div class="pre-wrap text-justify">{{ $project->description }}</div>

            </div>
            
            <div class="project-section pb-5">

                <p class="font-weight-bold">Cuvinte cheie:</p>

                <div class="">#rezist</div>

            </div>

            <div class="project-section pb-5">

                <p class="font-weight-bold">Fotografii:</p>

                <div class="d-flex flex-wrap justify-content-start">
                    
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/any?v=1">
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/any?v=2">
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/any?v=3">
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/any?v=4">
                    <img class="rounded mr-2" src="https://placeimg.com/100/80/any?v=5">
                    <a href="#" @click.prevent="alert('Upload image')">
                        <svg style="fill: currentColor;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100"><path  d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5c0-1.1.9-2 2-2zm0 2v14h14V5H5zm8 6h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2H9a1 1 0 0 1 0-2h2V9a1 1 0 0 1 2 0v2z"/></svg>
                    </a>
                </div>

            </div>

            <div class="project-section">

                <p class="font-weight-bold">Documente:</p>

                <div class="d-flex">
                    
                    <span>file.xls</span>

                </div>

            </div>

		</div>