### Instrucciones
1. Instalar Contact Form 7 y Advanced Custom Fields PRO ([Descarga ACF PRO](https://we.tl/t-Fh8q0cz2oH "Descarga ACF PRO")).
2. Descargar e instalar el plugin de `jobs-plugin-arconsa`.
3. Dentro del directorio `templates` crear un custom template llamado `vacancies-template.php` y agregar el siguiente bloque de código:

```php
<?php

/**
 * 
 * Template Name: vacancies
 * 
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();

$page_title = get_field('title') ?? '';
$page_description = get_field('description') ?? '';

$args_query = array(
    'post_type' => 'jobs',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'meta_key' => 'job_closing_date',
    'meta_type' => 'date',
    'orderby' => 'meta_value',
    'order' => "ASC",
);

$vacancies = new WP_Query($args_query);

?>
<main id="vacancies-template-d96e02">
    <div class="container">
        <?php if (!empty($page_title)) : ?>
            <h1 class="title-page text-center">
                <?= $page_title; ?>
            </h1>
        <?php endif; ?>

        <?php if (!empty($page_description)) : ?>
            <p class="page-description">
                <?= $page_description; ?>
            </p>
        <?php endif; ?>

        <?php if (!empty($vacancies)) : ?>
            <div class="vacancies-listing mt-5">
                <div class="row gy-4">
                    <?php while ($vacancies->have_posts()) :
                        $vacancies->the_post();
                        $job_description = get_field('job_description') ?? '';
                        $job_closing_date = get_field('job_closing_date') ?? '';
                    ?>
                        <div class="col-md-4 item-card">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        Vacante:
                                    </h5>
                                    <p class="card-text text-uppercase">
                                        <?= the_title(); ?>
                                    </p>

                                    <h5 class="card-title">
                                        Descripción:
                                    </h5>
                                    <div class="card-text">
                                        <?= $job_description; ?>
                                    </div>

                                    <h5 class="card-title">
                                        Fecha de cierre de convocatoria:
                                    </h5>
                                    <p class="card-text">
                                        <?= $job_closing_date; ?>
                                    </p>

                                    <a href="<?= the_permalink(); ?>" class="btn btn-primary text-decoration-none mt-5">Aplicar</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
```

------------
4. Crear un custom post type template llamado `single-jobs.php` y agregar el siguiente bloque de código:

```php
<?php

/**
 * 
 * Default single.
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

get_header();

$shortcode_form = get_field('shortcode_form', 'options') ?? '';
$job_description = get_field('job_description') ?? '';

?>

<main id="single-jobs">
	<div class="container">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>

				<h1 class="title-page text-center">
					<?= the_title(); ?>
				</h1>

				<?php if (!empty($job_description)) : ?>
					<p class="page-description">
						<?= $job_description; ?>
					</p>
				<?php endif; ?>

				<?= do_shortcode($shortcode_form); ?>

			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>
<script>
	$(document).ready(function() {
		$('#single-jobs .container form .add-button .btn')
			.click((ev) => {
				let section_id = $(ev.target).parent().parent().attr('id'); // get section id

				let num = $(`#${section_id} .cloned-inputs`).length; // how many "duplicatable" input fields we currently have
				let newNum = new Number(num + 1); // the numeric ID of the new input field being added

				// create the new element via clone(), and manipulate it's ID using newNum value
				let newElem = $(`#${section_id} #inputs-group` + num)
					.clone(true)
					.attr('id', 'inputs-group' + newNum)
					.addClass('active-rm-btn');

				// manipulate the name/id values of the input inside the new element
				let inputs = newElem.find('.row .col-6 input, .row .col-6 select, .row .col-12 textarea');
				inputs.each((index, element) => {
					$(element)
						.attr('id', (i, origValue) => {
							return !isNaN(origValue.slice(-1)) ?
								origValue.replace(origValue.slice(-1), newNum) :
								origValue + newNum;
						})
						.attr('name', (i, origValue) => {
							return !isNaN(origValue.slice(-1)) ?
								origValue.replace(origValue.slice(-1), newNum) :
								origValue + newNum;
						})
						.val("");
				});

				// manipulate the for value of the label inside the new element
				let labels = newElem.find('.row .col-6 label, .row .col-12 label');
				labels.each((index, element) => {
					$(element).attr('for', (i, origValue) => {
						return !isNaN(origValue.slice(-1)) ?
							origValue.replace(origValue.slice(-1), newNum) :
							origValue + newNum;
					});
				});

				// insert the new element after the last "duplicatable" input field
				$(`#${section_id} #inputs-group` + num).after(newElem);
			});

		$('#single-jobs .container form .cloned-inputs .remove-button #btn-remove')
			.click((ev) => {
				let currentParentElemID = $(ev.target).parent().parent().parent().attr('id');
				$(`#${currentParentElemID}`).remove();
			});
	});
</script>

<?php get_footer(); ?>
```

------------

5.  Usando el plugin de Contact Form 7, crear un formulario llamado **Formulario de solicitudes** y editar la plantilla del formulario con el siguiente bloque de código:

```html
<fieldset id="personal-information" class="row g-4">
   <legend class="text-uppercase">DATOS PERSONALES</legend>
   
   <div class="col-12 text-center">
      <label for="input-photo" class="form-label">Adjunta una foto de perfil (PNG, JPG, JPEG | max. 1MB)*</label>
      [file* photo limit:1mb filetypes:png|jpg|jpeg id:input-photo class:profile-photo]
   </div>

   <div class="col-12">
      <label for="inputFullname" class="form-label">Nombre y Apellidos*</label>
      [text* fullname id:inputFullname class:form-control]
   </div>

   <div class="col-4">
      <label for="documentSelect" class="form-label">Tipo de documento*</label>
      [select* documentType id:documentSelect class:form-select include_blank "CC" "Cédula de Extranjería" "Pasaporte" "PEP"]
   </div>

   <div class="col-8">
      <label for="inputDocNumber" class="form-label">Número de documento*</label>
      [number* documentNumber id:inputDocNumber class:form-control]
   </div>

   <div class="col-6">
      <label for="inputBirthdate" class="form-label">Fecha de Nacimiento*</label>
      [date* birthdate id:inputBirthdate class:form-control]
   </div>

   <div class="col-6">
      <label for="inputEmail" class="form-label">Correo Electrónico*</label>
      [email* email id:inputEmail class:form-control]
   </div>

   <div class="col-6">
      <label for="inputPhone" class="form-label">Teléfono*</label>
      [tel* phone id:inputPhone class:form-control]
   </div>

   <div class="col-6">
      <label for="inputCellphone" class="form-label">Teléfono Celular*</label>
      [tel* cellphone id:inputCellphone class:form-control]
   </div>

   <div class="col-6">
      <label for="inputCity" class="form-label">Ciudad de Residencia*</label>
      [select* city id:inputCity class:form-select include_blank "Bogotá" "Medellín" "Cali" "Barranquilla" "Cartagena" "Cúcuta" "Soledad" "Ibagué" "Bucaramanga" "Santa Marta" "Villavicencio" "Soacha" "Pereira" "Bello" "Valledupar" "Montería" "Pasto" "Manizales" "Buenaventura" "Neiva" "Barrancabermeja" "Palmira" "Armenia" "Popayán" "Sincelejo" "Itagüí" "Envigado" "Tuluá" "Tunja" "Ipiales" "Yopal" "Fusagasugá" "Facatativá" "Zipaquirá" "Rionegro" "Quibdó"]
   </div>

   <div class="col-6">
      <label for="inputAddress" class="form-label">Dirección (Nomenclatura y barrio)*</label>
      [text* address id:inputAddress class:form-control]
   </div>

   <div class="col-6">
      <label for="inputSalary" class="form-label">Aspiración salarial*</label>
      [number* salary id:inputSalary class:form-control]
   </div>

   <div class="col-6">
      <label for="inputCloseRelative" class="form-label">¿Algún familiar labora en Arconsa?*</label>
      [text* closeRelative id:inputCloseRelative class:form-control]
      <div class="form-text">En caso tal de ser afirmativa su respuesta indique nombre y cargo en el cual se desempeña</div>
   </div>
</fieldset>

<fieldset id="job-profile" class="row g-4 pt-4 pb-3">
   <legend class="text-uppercase">PERFIL LABORAL</legend>
   
   <div class="col-12">
      <label for="inputExperience" class="form-label">Años de Experiencia*</label>
      [select* experience id:inputExperience class:form-select include_blank "1" "2" "3" "4" "5" "+5" "+10"]
   </div>

   <div class="col-12">
      <label for="inputWantToWork" class="form-label">¿Por qué deseas trabajar en Arconsa?*</label>
      [textarea* whyWantToWork id:inputWantToWork x3 class:form-control]
   </div>

   <div class="col-12">
      <label for="inputSummary" class="form-label">Realiza un breve resumen de la hoja de vida, inicia con profesion u oficio, conocimientos o experiencia y principales actividades desempeñadas.*</label>
      [textarea* summary id:inputSummary x3 class:form-control]
   </div>

   <div class="col-4">
      <label for="inputEducationalLevel" class="form-label">Nivel educativo*</label>
      [select* educationalLevel id:inputEducationalLevel class:form-select include_blank "Primaria" "Bachillerato" "Técnico" "Universitario" "Especialización" "Maestría" "Doctorado"]
   </div>

   <div class="col-4">
      <label for="inputDegreeObtained" class="form-label">Título obtenido*</label>
      [text* degreeObtained id:inputDegreeObtained class:form-control]
   </div>

   <div class="col-4">
      <label for="inputInstitution" class="form-label">Institución*</label>
      [text* institution id:inputInstitution class:form-control]
   </div>

   <div class="col-4">
      <label for="inputAcademicStatus" class="form-label">Estado Académico*</label>
      [select* academicStatus id:inputAcademicStatus class:form-select include_blank "Graduado" "En proceso" "Incompleto"]
   </div>

   <div class="col-4">
      <label for="inputGraduationYear" class="form-label">Año de graduación*</label>
      [text* graduationYear id:inputGraduationYear class:form-control]
      <div class="form-text">En caso de ser abandonado o suspendido especificar año en que suspendió</div>
   </div>

   <div class="col-4">
      <label for="inputProfessionalLicence" class="form-label">¿Tiene tarjeta profesional o licencia?*</label>
      [select* professionalLicence id:inputProfessionalLicence class:form-select include_blank "Si" "No" "No aplica"]
   </div>
</fieldset>

<fieldset id="work-experience" class="row g-4 pt-4 pb-3">
   <legend class="text-uppercase">EXPERIENCIA LABORAL</legend>
   
   <div id="inputs-group1" class="col-12 cloned-inputs">
      <div class="row g-0 flex-nowrap">
         <div class="col-auto flex-fill">
            <div class="row g-4">
               <div class="col-6">
                  <label for="inputCompanyName" class="form-label">Nombre de la empresa*</label>
                  [text* companyNameWE id:inputCompanyName class:form-control]
               </div>

               <div class="col-6">
                  <label for="inputPosition" class="form-label">Cargo*</label>
                  [text* positionWE id:inputPosition class:form-control]
               </div>

               <div class="col-12">
                  <label for="inputResponsibilities" class="form-label">Funciones*</label>
                  [textarea* responsabilitiesWE id:inputResponsibilities x3 class:form-control]
               </div>

               <div class="col-6">
                  <label for="inputEntryDate" class="form-label">Fecha de ingreso*</label>
                  [date* entryDateWE id:inputEntryDate class:form-control]
               </div>

               <div class="col-6">
                  <label for="inputRetirementDate" class="form-label">Fecha de retiro*</label>
                  [date* retirementDateWE id:inputRetirementDate class:form-control]
               </div>
            </div>
         </div>
         
         <div class="col-auto remove-button">
            <button type="button" id="btn-remove" class="btn btn-secondary rounded-circle">×</button>
         </div>
      </div>
   </div>
   
   <div class="col-12 add-button">
      <button type="button" id="addBtn-WE" class="btn btn-secondary">Agregar otro</button>
   </div>
</fieldset>

<fieldset id="specific-experience" class="row g-4 pt-4 pb-3">
   <legend class="text-uppercase">EXPERIENCIA ESPECÍFICA</legend>
   <div class="mt-0 form-description"><span>(para el cargo al que está aplicando)</span></div>
   
   <div id="inputs-group1" class="col-12 cloned-inputs">
      <div class="row g-0 flex-nowrap">
         <div class="col-auto flex-fill">
            <div class="row g-4">
               <div class="col-6">
                  <label for="inputCompanyNameSE" class="form-label">Nombre de la empresa*</label>
                  [text* companyNameSE id:inputCompanyNameSE class:form-control]
               </div>

               <div class="col-6">
                  <label for="inputPositionSE" class="form-label">Cargo*</label>
                  [text* positionSE id:inputPositionSE class:form-control]
               </div>

               <div class="col-12">
                  <label for="inputResponsibilitiesSE" class="form-label">Funciones*</label>
                  [textarea* responsabilitiesSE id:inputResponsibilitiesSE x3 class:form-control]
               </div>

               <div class="col-6">
                  <label for="inputEntryDateSE" class="form-label">Fecha de ingreso*</label>
                  [date* entryDateSE id:inputEntryDateSE class:form-control]
               </div>

               <div class="col-6">
                  <label for="inputRetirementDateSE" class="form-label">Fecha de retiro*</label>
                  [date* retirementDateSE id:inputRetirementDateSE class:form-control]
               </div>
            </div>
         </div>

         <div class="col-auto remove-button">
            <button type="button" id="btn-remove" class="btn btn-secondary rounded-circle">×</button>
         </div>
      </div>
   </div>

   <div class="col-12 add-button">
      <button type="button" id="addBtn-SE" class="btn btn-secondary">Agregar otro</button>
   </div>
</fieldset>

<fieldset id="complementary-training" class="row g-4 pt-4 pb-3">
   <legend class="text-uppercase">FORMACIÓN COMPLEMENTARIA</legend>
   
   <div id="inputs-group1" class="col-12 cloned-inputs">
      <div class="row g-0 flex-nowrap">
         <div class="col-auto flex-fill">
            <div class="row g-4">
               <div class="col-6">
                  <label for="inputTrainingType" class="form-label">Tipo de capacitación o certificación*</label>
                  [text* trainingType id:inputTrainingType class:form-control]
               </div>

               <div class="col-6">
                 <label for="inputProgramName" class="form-label">Nombre del programa*</label>
                 [text* programName id:inputProgramName class:form-control]
               </div>

               <div class="col-6">
                  <label for="inputInstitutionCT" class="form-label">Institución*</label>
                  [text* institutionCT id:inputInstitutionCT class:form-control]
               </div>

               <div class="col-6">
                  <label for="inputCertificationDate" class="form-label">Fecha de certificación*</label>
                  [date* certificationDate id:inputCertificationDate class:form-control]
               </div>
            </div>
         </div>

         <div class="col-auto remove-button">
            <button type="button" id="btn-remove" class="btn btn-secondary rounded-circle">×</button>
         </div>
      </div>
   </div>
   
   <div class="col-12 add-button">
      <button type="button" id="addBtn-CT" class="btn btn-secondary">Agregar otro</button>
   </div>
</fieldset>

<fieldset id="office-tools" class="row g-4 pt-4 pb-3">
   <legend class="text-uppercase">HERRAMIENTAS OFIMÁTICAS, LÍCENCIAS O IDIOMAS</legend>
   <div class="mt-0 form-description"><span>Solo incluir las que sean relevantes para la convocatoria a la que está aplicando.</span></div>
   
   <div id="inputs-group1" class="col-12 cloned-inputs">
      <div class="row g-0 flex-nowrap">
         <div class="col-auto flex-fill">
            <div class="row g-4">
               <div class="col-6">
                  <label for="input-tool" class="form-label">Herramienta</label>
                  [text tool id:input-tool class:form-control]
               </div>

               <div class="col-6">
                  <label for="input-level" class="form-label">Nivel</label>
                  [select level id:input-level class:form-select include_blank "Básico" "Intermedio" "Avanzado"]
               </div>
            </div>
         </div>
        
         <div class="col-auto remove-button">
            <button type="button" id="btn-remove" class="btn btn-secondary rounded-circle">×</button>
         </div>
      </div>
   </div>
   
   <div class="col-12 add-button">
      <button type="button" id="addBtn-OT" class="btn btn-secondary">Agregar otro</button>
   </div>
</fieldset>

<fieldset id="termsCoditions" class="row g-4 pt-4 pb-3">
    <div class="col-12">
        [acceptance termsCoditions id:termsCoditions-input] Acepto los <a href="https://f.hubspotusercontent40.net/hubfs/6039096/Poli%CC%81tica-tratamiento-datos_febrero-2022.pdf" target="_blank">términos y condiciones</a> [/acceptance]
        <div class="form-text">Al registrar tu hoja de vida en la plataforma, aceptas compartir con Arconsa tus datos personales y profesionales relacionados con la posibilidad de obtener una oportunidad laboral con nosotros. Tu información será tratada de acuerdo con nuestra política de tratamiento de datos personales</div>
        <p><span></span></p>
        <div class="form-text">Los campos marcados con (*) son obligatorios.</div>
    </div>
</fieldset>

<div id="submit-btn" class="mt-4 text-center">
   [submit class:btn class:btn-primary "Enviar hoja de vida"]
</div>
```

------------

6. En la pestaña **Ajustes adicionales** del plugin del formulario, agregar `skip_mail: on` y guardar los cambios.

7. Copiar el shortcode del formulario y pegarlo en el campo disponible dentro del Option Page llamado **Theme Settings**.