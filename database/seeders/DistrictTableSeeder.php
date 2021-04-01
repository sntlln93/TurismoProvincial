<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\District;
use App\Models\Image;

class DistrictTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $district = District::create([
            'id' => 1,
            'name' => 'Capital',
            'mayor' => 'Inés Brizuela Doria',
            'description' => 'La Rioja es la ciudad capital de la provincia de La Rioja en Argentina. Se encuentra ubicada al centroeste de la provincia, en el departamento Capital, cabecera de La Rioja. Está servida por el Aeropuerto Capitán Vicente Almandos Almonacid (Códigos IRJ/SANL) con vuelos a la ciudad de Buenos Aires y San Fernando del Valle de Catamarca.',
            'slug' => 'capital',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);


        $district = District::create([
            'id' => 2,
            'name' => 'Gral. San Martín',
            'mayor' => 'Rodolfo Nicolás Flores',
            'description' => 'General San Martín es un departamento ubicado al sur de la provincia de La Rioja (Argentina). Su Cabecera departamental es el poblado de Ulapes.',
            'slug' => 'gral-san-martin',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 3,
            'name' => 'Arauco',
            'mayor' => 'María Florencia López',
            'description' => 'El 10 de agosto de 1877 mientras gobernaba la provincia Vicente Almandos Almonacid y era diputado por el Departamento arauco Jose V. de la Vega, Se sanciona la ley que creaba los actuales departamentos Castro Barros y Arauco y a su vez determinaba que la cabecera de este último sería Villa de la Concepción de Aimogasta. Pero recién Se pondrá en vigencia durante el gobierno de Guillermo sanroman mediante decreto del 25 de octubre de 1894.',
            'slug' => 'arauco',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 4,
            'name' => 'Castro Barros',
            'mayor' => 'Marcelo Del Moral',
            'description' => 'Este departamento es popularmente conocido como "la costa riojana". Este apelativo se debe a que las localidades se ubican sobre el "costado" oriental del cordón de Velasco. La vía terrestre más importante de acceso es la ruta nacional N° 75, que une la ciudad de La Rioja con la localidad de Aimogasta. Su nombre honra la memoria del sacerdote riojano Pedro Ignacio de Castro Barros, miembro del cuarto período de la Asamblea del Año XIII y del Congreso de Tucumán.',
            'slug' => 'castro-barros',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 5,
            'name' => 'Chamical',
            'mayor' => 'Dora Rodríguez',
            'description' => 'Chamical se conoce como cuna de la investigación aerospacial de Argentina por ser sede del Centro de Experimentación. Desde 1989 no se realizan experimentos en este centro que ha descendido de categoría pasando a ser Destacamento aeronáutico militar.',
            'slug' => 'chamical',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 6,
            'name' => 'Chilecito',
            'mayor' => 'Rodrigo Brizuela y Doria',
            'description' => 'Chilecito es un departamento ubicado en la provincia de La Rioja (Argentina). La cabecera departamental es la ciudad de Chilecito. El departamento comprende la ciudad de Chilecito y los distritos: Anguinán, Guanchín, La Puntilla, Los Sarmientos, Malligasta, Miranda, Nonogasta, San Miguel, San Nicolás, Santa Florentina, Sañogasta, Tilimuqui, y Vichigasta.',
            'slug' => 'chilecito',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 7,
            'name' => 'Gral. Felipe Varela',
            'mayor' => 'Yamil Sarruf',
            'description' => 'General Felipe Varela es uno de los 18 departamentos en que se divide la provincia argentina de La Rioja. Su principal vía de comunicación es la RN 76. La localidad de Villa Unión, cabecera del departamento, está a 274 km de distancia de la ciudad de La Rioja y a 1277 km de la ciudad de Buenos Aires. El departamento se llamó Coronel Felipe Varela hasta septiembre de 2014,​ cuando por ley su nombre fue cambiado a General Felipe Varela luego de que en junio de 2012 Felipe Varela fuera ascendido post-mortem a general del Ejército Argentino.',
            'slug' => 'gral-felipe-varela',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 8,
            'name' => 'Famatina',
            'mayor' => 'Alberto Godoy',
            'description' => 'Famatina es un departamento ubicado en la provincia de La Rioja (Argentina). Su ciudad cabecera, la localidad de Famatina, se encuentra a una distancia de 230 km de la ciudad de La Rioja y a 1234 km de la ciudad de Buenos Aires. La palabra "Famatina" derivaría de la voz quechua "Huamatinag" o posiblemente "wamatinag" que significa "madre de los metales".',
            'slug' => 'famatina',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 9,
            'name' => 'Gral. Ángel V. Peñaloza',
            'mayor' => 'Ricardo Romero',
            'description' => 'En virtud de la ley provincial 2890 de 1964, el departamento debe su nombre al caudillo riojano Ángel Vicente Peñaloza. Antes de esa fecha se denominaba oficialmente departamento Vélez Sarfield.',
            'slug' => 'gral-angel-v-penaloza',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 10,
            'name' => 'Gral. Belgrano',
            'mayor' => 'Carlos Alberto Romero',
            'description' => 'General Belgrano es uno de los 18 departamentos en los que se divide la provincia de La Rioja (Argentina). Se encuentra el la región sudeste de la provincia, en el área llamada "De los LLanos" por sus características topográficas. Olta, la ciudad cabecera del departamento es llamada "Jardín de los Llanos". Su nombre honra a Manuel Belgrano, General del Ejército del Norte.',
            'slug' => 'gral-belgrano',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 11,
            'name' => 'Gral. Juan Facundo Quiroga',
            'mayor' => 'Mario Claudio Luján',
            'description' => 'Localizado en la provincia de La Rioja, General Juan Facundo Quiroga es un municipio cuya superficie, población, altitud y otra información importante se proporciona a continuación.
            Para todos sus procedimientos administrativos, puede dirigirse al ayuntamiento de General Juan Facundo Quiroga en la dirección y horarios indicados en esta página, o contactar a la recepción del ayuntamiento por teléfono o por correo electrónico según su preferencia y datos disponibles.',
            'slug' => 'gral-juan-facundo-quiroga',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 12,
            'name' => 'Gral. Lamadrid',
            'mayor' => 'Daniela Mabel López Roudier',
            'description' => 'General Lamadrid es uno de los 18 departamentos en los que se divide la provincia de La Rioja (Argentina). La cabecera del departamento es la localidad de Villa Castelli, donde se concentra casi la totalidad de la población. Se encuentra a 330 km de la Ciudad de La Rioja y a 1315 km de la Ciudad de Buenos Aires- El principal acceso lo constituye la RN 76. El departamento cuenta con dos escuelas de nivel inicial y una escuela de nivel medio de especialización agrotécnica, centro de atención promaria en salud, servicios públicos y comunicaciones, centralizados en la localidad cabecera.',
            'slug' => 'gral-lamadrid',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 13,
            'name' => 'Gral. Ortiz de Ocampo',
            'mayor' => 'Jorge Hernán Salomón',
            'description' => 'General Ortiz de Ocampo es un departamento ubicado en la provincia de La Rioja (Argentina) con una economía principalmente ganadera y con desarrollo de la olivicultura (Colonia Ortiz de Ocampo). También es un departamento rico en bellezas naturales y paisajes pintorescos, lo que permite un incipiente nodo turístico donde cada vez más gente realiza el turismo rural. Tiene una de las fiestas más visitadas cada año en los llanos riojanos, la fiesta de Santa Rita en la ciudad de Catuna, un emblema de las causas imposibles la imagen es una clásica representación de alrededor del siglo XVIII, traída al pueblo sin referencia histórica de su fecha. en esta festividad religiosa se aglomera una creciente cantidad de gente cada año por su emotividad y sentido de religiosidad que se le da a la misma. Su actual intendente es Jorge Salomón (exdiputado por este departamento) y su vice es Fabian Gauna, su diputado, electo en este período (en 2019), es Germán Díaz.',
            'slug' => 'gral-ortiz-de-ocampo',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 14,
            'name' => 'Independencia',
            'mayor' => 'Juan Gonzalo Herrera',
            'description' => 'El departamento fue creado por la ley 108 del 28 de septiembre de 1864 (156 años), norma que también fijó como localidad cabecera a Patquía.',
            'slug' => 'independencia',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 15,
            'name' => 'San Blas de los Sauces',
            'mayor' => 'Silvio Villagra',
            'description' => 'San Blas de los Sauces es un departamento ubicado en la provincia de La Rioja, (Argentina). Su ciudad cabecera San Blas se encuentra a 171 km de distancia de la ciudad de La Rioja y a 1249 km de la ciudad de Buenos Aires.',
            'slug' => 'san-blas-de-los-sauces',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 16,
            'name' => 'Rosario Vera Peñaloza',
            'mayor' => 'Cristián Eduardo Perez',
            'description' => 'Rosario Vera Peñaloza es un departamento ubicado en la provincia de La Rioja (Argentina). El Departamento Rosario Vera Peñaloza, es el único en la provincia que lleva nombre de mujer, en homenaje a la llamada Maestra de la Patria, que le fue impuesto por Ley 2890, del 28 de julio de 1964 (56 años)',
            'slug' => 'rosario-vera-peñaloza',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 17,
            'name' => 'Sanagasta',
            'mayor' => 'Federico Sbiroli',
            'description' => 'Sanagasta es uno de los 18 departamentos en los que se divide la provincia de La Rioja (Argentina).',
            'slug' => 'sanagasta',
        ]);

        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);

        $district = District::create([
            'id' => 18,
            'name' => 'Vinchina',
            'mayor' => 'Gustavo Arias',
            'description' => 'Existen varias versiones, atribuyéndose a palabras quechuas, o de la lengua cacán. Según una versión, el nombre Vinchina derivaría de la combinación de las expresiones "yichi" (labrar la tierra, y el sustantivo derivado lugar labrado) y "anah" (alto, arriba, altura) lo que haría referencia a "lugar labrado en altura". Otra explicación hace referencia a la expresión cacán que significa "lugar con algarrobos". Finalmente, un autor nacido en el departamento indica que el nombre Vinchina surge de la unión de las palabras "vil" (lugar), "chiri" (frío) y "na" (verbo hacer), lo que equivaldría a "lugar donde hace frío".',
            'slug' => 'vinchina',
        ]);
        
        Image::create([
            'path' => 'img/districts/capital.jpg',
            'imageable_id' => $district->id,
            'imageable_type' => 'App\\District',
        ]);
    }
}
