<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        News::insert([
            [   
                "id"=>1,
                "user_id"=>"1",
                "image"=>"/storage/image/uBP0kB7lntG7efjJsT2PaVjUMHRv5lJn3iNlYKKZ.png",
                "title"=>"Business Law Community Summit 2021",
                "content"=>"Summit adalah acara yang ditujukan kepada seluruh anggota tetap dan anggota tidak tetap National Business Law Community 2021. Acara Summit ini meliputi : Laporan Pertanggung Jawaban Anggota Tetap; Sesi PenetapaN Dewan Pertimbangan Organisasi (“DPO”); Pemilihan Executive Director Dan Struktur Organisasi NBLC; Perekrutan Anggota Tetap NBLC; serta Persidangan Penetapan Anggaran Dasar.",
                "created_at"=> null,
                "updated_at"=>"2021-10-20 12:58:53"
            ],
            [
                "id"=>2,
                "user_id"=>"1",
                "image"=>"/storage/image/3L3BgS6PHHCrYnsEyjxbilQhu8YmVbzHlhvGW7AG.png",
                "title"=>"Pre Event National Business Law Community Summit",
                "content"=>"Summit adalah acara yang ditujukan kepada seluruh anggota tetap dan anggota tidak tetap National Business Law Community 2021. Acara Summit ini meliputi : Laporan Pertanggung Jawaban Anggota Tetap; Sesi PenetapaN Dewan Pertimbangan Organisasi (“DPO”); Pemilihan Executive Director Dan Struktur Organisasi NBLC; Perekrutan Anggota Tetap NBLC; serta Persidangan Penetapan Anggaran Dasar.",
                "created_at"=> null,
                "updated_at"=>"2021-10-20 12:59:39"
            ],
            [
                "id"=>3,
                "user_id"=>"1",
                "image"=>"/storage/image/5SjJ3XrTTRzXPEznmugzB2dlGwH2oEsEufS2dx1T.png",
                "title"=>"Paper Presentation Competiton (PPC)",
                "content"=>"Summit adalah acara yang ditujukan kepada seluruh anggota tetap dan anggota tidak tetap National Business Law Community 2021. Acara Summit ini meliputi : Laporan Pertanggung Jawaban Anggota Tetap; Sesi PenetapaN Dewan Pertimbangan Organisasi (“DPO”); Pemilihan Executive Director Dan Struktur Organisasi NBLC; Perekrutan Anggota Tetap NBLC; serta Persidangan Penetapan Anggaran Dasar.",
                "created_at"=> null,
                "updated_at"=>"2021-10-20 12:59:52"
            ],            
            [
                "id"=>"17",                
                "user_id"=>"1",
                "image"=>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbhQr-Zdr7vnBkwr3buu6PTm8OcKJHmShQgg&usqp=CAU",
                "title"=>"Lorem, ipsum dolor sit amet consectetur adipisicing elit.",
                "content"=>"<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident ex nihil voluptatum iste nisi aspernatur perferendis praesentium atque magni repudiandae deleniti quo dolorum, culpa quae ipsa, quaerat minus dolor consequuntur?</p>",
                "created_at"=>null,
                "updated_at"=>"2021-10-14 02:25:59"
            ],
            [
                "id"=>"18",
                "user_id"=>"1",
                "image"=>"/storage/image/doTKqlEFdQkP9rweoyQVXX7sgKwuVegEchFvnIBs.jpg",
                "title"=>"A lawyer or attorney is a person who practices law",
                "content"=>"<p>A lawyer or attorney is a person who practices law, as an advocate, attorney at law, barrister, barrister-at-law, bar-at-law, canonist, canon lawyer, civil law notary, counsel, counselor, solicitor, legal executive, or public servant preparing, interpreting and applying the law, but not as a paralegal or charter executive secretary.[1] Working as a lawyer involves the practical application of abstract legal theories and knowledge to solve specific individualized problems, or to advance the interests of those who hire lawyers to perform legal services. The role of the lawyer varies greatly across different legal jurisdictions.</p>",
                "created_at"=>null,
                "updated_at"=>"2021-10-02 13:43:56"
            ],
            [
                "id"=>"19",
                "user_id"=>"1",
                "image"=>"https://cdn.antaranews.com/cache/800x533/2021/07/06/saoo.png",
                "title"=>"Sword Art Online",
                "content"=>"<p>Jakarta (ANTARA) - Serial animasi <br>Dikutip dari Crunchyroll, Selasa, pengumuman itu disampaikan studio melalui Aniplex Online Fest 2021 yang juga mengungkapkan visual baru untuk film anime tersebut. Visual baru menunjukkan tiga karakter utama, Kirito, Asuna, dan Mito di dunia Aincrad dan refleksi diri mereka yang sebenarnya di dalam air.</p>",
                "created_at"=>"2021-10-02 09:09:43",
                "updated_at"=>"2021-10-02 09:09:43"
            ],
            [
                "id"=>"6",
                "user_id"=>"1",
                "image"=>"https://upload.wikimedia.org/wikipedia/commons/3/35/Neckertal_20150527-6384.jpg",
                "title"=>"Lorem Ipsum is not simply random text",
                "content"=>"<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>",
                "created_at"=>"2021-10-14 00:13:54",
                "updated_at"=>"2021-10-14 00:13:54"
            ],
            [
                "id"=>"7",
                "user_id"=>"1",
                "image"=>"https://awsimages.detik.net.id/community/media/visual/2020/06/22/jawara-world-landscape-photographer-3.png?w=750&q=90",
                "title"=>"There are many variations of passages of Lorem Ipsum available",
                "content"=>"<p>first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable</p>",
                "created_at"=>"2021-10-14 00:15:04",
                "updated_at"=>"2021-10-14 00:15:04"
            ],
            [
                "id"=>"8",
                "user_id"=>"1",
                "image"=>"https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MXx8fGVufDB8fHx8&w=1000&q=80",
                "title"=>"the more obscure Latin words, consectetur",
                "content"=>"<p>tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable</p>",
                "created_at"=>"2021-10-14 00:16:00",
                "updated_at"=>"2021-10-14 00:16:00"
            ],
            [
                "id"=>"9",
                "user_id"=>"1",
                "image"=>"https://matamu.net/wp-content/uploads/2020/03/Foto-Landscpae-Gunung-dan-Padang-Rumput.jpg",
                "title"=>"NBLC Summit 2021's most prestigious event is here",
                "content"=>"<p>reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>",
                "created_at"=>"2021-10-14 02:15:55",
                "updated_at"=>"2021-10-14 02:15:55"
            ],
            [
                "id"=>"10",
                "user_id"=>"1",
                "image"=>"https://images.unsplash.com/photo-1604223190546-a43e4c7f29d7?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8bW91bnRhaW4lMjBsYW5kc2NhcGV8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80",
                "title"=>"comes from sections 1.10.32 and 1.10.33 of",
                "content"=>"<p>(The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\",
                 comes from a line in section 1.10.32.</p>",
                "created_at"=>"2021-10-14 05:26:23",
                "updated_at"=>"2021-10-14 05:26:23"
            ],
            [
                "id"=>"11",
                "user_id"=>"1",
                "image"=>"https://img.freepik.com/free-vector/nature-scene-with-river-hills-forest-mountain-landscape-flat-cartoon-style-illustration_1150-37326.jpg?size=626&ext=jpg",
                "title"=>"The standard Lorem Ipsum passage, used since the 1500s",
                "content"=>"<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>",
                "created_at"=>"2021-10-18 06:54:23",
                "updated_at"=>"2021-10-18 06:54:23"
            ],
            [
                "id"=>"12",
                "user_id"=>"1",
                "image"=>"https://media.istockphoto.com/photos/mount-hood-oregon-picture-id1268487061?b=1&k=20&m=1268487061&s=170667a&w=0&h=3fHYwaImlqUETcjCnSV7YO2-PzCFvaX6VSQaiGfWqpc=",
                "title"=>"Section 1.10.32 of \"de Finibus Bonorum et Malorum\",
                 written by Cicero in 45 BC",
                "content"=>"<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>",
                "created_at"=>"2021-10-18 07:20:24",
                "updated_at"=>"2021-10-18 07:20:24"
            ],
            [
                "id"=>"13",
                "user_id"=>"1",
                "image"=>"https://lh6.googleusercontent.com/0-Juq0c7Q-G6oJpvr3quvfmcgChsmNumNhTGncBSX2JYeL3gErLhnEF5m1sVQU9Lr-MnMgPupnm6eGt_-tviqWe_bWWwF8WRTBnZuo5ZKW3Iazz4sBzKOfCIDOCtd7A1eTg78dNE",
                "title"=>"Section 1.10.33 of \"de Finibus Bonorum et Malorum\",
                 written by Cicero in 45 BC",
                "content"=>"<p>\"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?\"</p>",
                "created_at"=>"2021-10-18 07:32:25",
                "updated_at"=>"2021-10-18 07:32:25"
            ],
            [
                "id"=>"14",
                "user_id"=>"1",
                "image"=>"https://photographylife.com/wp-content/uploads/2020/03/Dan-Ballard-Landscapes-6.jpg",
                "title"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit",
                "content"=>"<p>minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>",
                "created_at"=>"2021-10-18 07:36:28",
                "updated_at"=>"2021-10-18 07:36:28"
            ],
            [
                "id"=>"15",
                "user_id"=>"1",
                "image"=>"https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/130238819/original/d4096d4950eba421600f21c6c753c19375222eb6/draw-you-a-landscape-image-with-ms-paint.png",
                "title"=>"text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
                "content"=>"<p>survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>",
                "created_at"=>"2021-10-18 07:38:59",
                "updated_at"=>"2021-10-18 07:38:59"],
            [
                "id"=>"16",
                "user_id"=>"1",
                "image"=>"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTuQq7a7GxA6dM1g87sr8EPnlaaymZ6H2e-yQ&usqp=CAU",
                "title"=>"sometimes on purpose (injected humour and the like)",
                "content"=>"<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</p>",
                "created_at"=>"2021-10-18 07:42:34",
                "updated_at"=>"2021-10-18 07:42:34"
            ]
        ]);
    }
}
