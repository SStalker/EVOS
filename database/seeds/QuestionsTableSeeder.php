<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Beispiel-Quiz DGL*/

        DB::table('questions')->insert([
            'question' => 'Eine Lösung der Differentialgleichung $ y\'\' + 4y= 0 $ ist...',
            'quiz_id' => 3,
            'answerA' => '$\sin(2x+1) $',
            'answerB' => '$ \sin(4x) $',
            'answerC' => '$ \cos(4x) $',
            'answerD' => '$ e^{2x} $',
            'correct_answers' => '{"a": true, "b": false, "c": false, "d": false}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Gegeben ist die Differentialgleichung 
            $ y\'=3x^2+1 $. 
            Welche Steigung besitzt das Richtungselement im Punkt $x=1,y=1$.',
            'quiz_id' => 3,
            'answerA' => '$2$',
            'answerB' => '$3$',
            'answerC' => '$4$',
            'answerD' => '$5$',
            'correct_answers' => '{"a": false, "b": false, "c": true, "d": false}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Laut Laplace-Transformationstabelle ist 
            ${\cal L}\{ \sin(2x) \} = \dfrac{2}{s^2+4} $.
            Was ist die Laplace-Transformierte der Funktion   
            $e^{3x}\sin (2x) $?',
            'quiz_id' => 3,
            'answerA' => '$\dfrac{2}{s^2-6s+13}$',
            'answerB' => '$\dfrac{2e^{-3s}}{s^2+6s-13}$',
            'answerC' => '$\dfrac{2e^{3s}}{s^2+4}$',
            'answerD' => '$\dfrac{2}{(s-3)(s^2+4)}$',
            'correct_answers' => '{"a": true, "b": false, "c": false, "d": false}'
        ]);

        /*Beispiel-Quiz Reihen*/

        DB::table('questions')->insert([
            'question' => 'Wie lautet der Entwicklungspunkt der Reihe $\sum_{n=0}^\infty \dfrac{n^2+1}{3^n} (3x+6)^n $ ?',
            'quiz_id' => 4,
            'answerA' => '$-6 $',
            'answerB' => '$3$',
            'answerC' => '$-2$',
            'answerD' => '$-3$',
            'correct_answers' => '{"a": false, "b": false, "c": true, "d": false}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Berechnen Sie den Konvergenzradius $\rho$ 
            der Reihe $\sum_{n=1}^\infty 2^n n^3 (1+x)^n$.',
            'quiz_id' => 4,
            'answerA' => '$1$',
            'answerB' => '$-1$',
            'answerC' => '$2$',
            'answerD' => '$\dfrac{1}{2}$',
            'correct_answers' => '{"a": false, "b": false, "c": false, "d": true}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Gegeben ist die 6-periodische Funktion 
            $f(x)=\begin{cases} 5 & \mbox{wenn } -3\le x<0 ,
            -2 & \mbox{wenn }  0\le x <3  
			\end{cases} $.
            Man berechne den Wert der zugehörigen Fourierreihe $FR(f)(3)$.',
            'quiz_id' => 4,
            'answerA' => '$\dfrac{1}{2}$',
            'answerB' => '$\dfrac{3}{2}$',
            'answerC' => '$\dfrac{5}{2}$',
            'answerD' => '$\dfrac{7}{2}$',
            'correct_answers' => '{"a": false, "b": false, "c": false, "d": true}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Gegeben ist die  Fourierreihe
            $FR(f)(x) = 4-\sum_{n=1}^\infty \left( \dfrac{(-1)^n}{n^2} \cos(nx) +\dfrac{1}{n} \sin(nx)\right) $.\\
            Welchen Wert besitzt der Fourierkoeffizient 
            $a_5 = \dfrac{1}{\pi}\int_{-\pi}^{\pi} f(x)\cos(5x)dx$?
            der Reihe $\sum_{n=1}^\infty 2^n n^3 (1+x)^n$.',
            'quiz_id' => 4,
            'answerA' => '$\dfrac{1}{5}$',
            'answerB' => '$\dfrac{-1}{5}$',
            'answerC' => '$\dfrac{1}{25}$',
            'answerD' => '$\dfrac{1}{25/pi}$',
            'correct_answers' => '{"a": false, "b": false, "c": true, "d": false}'
        ]);

        /*Beispiel-Quiz Komplexe*/

        DB::table('questions')->insert([
            'question' => 'Man berechne $(3+2j)e^{j\dfrac{\pi}{2}}$.',
            'quiz_id' => 5,
            'answerA' => '$-2+3j$',
            'answerB' => '$2+3j$',
            'answerC' => '$ -3-2j$',
            'answerD' => '$-3+2j$',
            'correct_answers' => '{"a": true, "b": false, "c": false, "d": false}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Wie ist der Betrag $| (1+j)e^{2j +\pi}|$ ?',
            'quiz_id' => 5,
            'answerA' => '$\sqrt{2} e^2$',
            'answerB' => '$2e^\pi$',
            'answerC' => '$ \sqrt{2} e^2$',
            'answerD' => '$\sqrt{2} e^\pi $',
            'correct_answers' => '{"a": false, "b": false, "c": false, "d": true}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Wenn zwei komplexe Zahlen multipliziert werden, werden ...?',
            'quiz_id' => 5,
            'answerA' => 'ihre Winkel addiert.',
            'answerB' => 'ihre Radien addiert.',
            'answerC' => 'ihre Realteile addiert.',
            'answerD' => 'ihre Imaginärteile addiert.',
            'correct_answers' => '{"a": true, "b": false, "c": false, "d": false}'
        ]);

        /*Beispiel-Quiz Funktionen mit mehreren Veränderlichen*/

        DB::table('questions')->insert([
            'question' => 'Gegeben ist die Funktion $f(x,y)=x^2+2y$. Man berechne $\nabla f(1,1)$.',
            'quiz_id' => 6,
            'answerA' => '$\begin{pmatrix} 2 \\ 2 \end{pmatrix} $',
            'answerB' => '$\begin{pmatrix} 0 \\ 2 \end{pmatrix} $',
            'answerC' => '$\begin{pmatrix} 1 \\ 1 \end{pmatrix} $',
            'answerD' => '$\begin{pmatrix} 2 \\ 0 \end{pmatrix} $',
            'correct_answers' => '{"a": true, "b": false, "c": false, "d": false}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Der Gradient einer Funktion $f$ im Punkt $\vec{x}_0$ sei $\nabla f(\vec{x}_0)=
                            \begin{pmatrix} 2 \\ -1 \end{pmatrix} $. 
                            Wie groß ist die Steigung im Punkt $\vec{x}_0$ in Richtung des Vektors $\vec{a}=\begin{pmatrix} 1 \\ 0 \end{pmatrix}$?',
            'quiz_id' => 6,
            'answerA' => '$1 $',
            'answerB' => '$0$',
            'answerC' => '$-1$',
            'answerD' => '$2$',
            'correct_answers' => '{"a": false, "b": false, "c": false, "d": true}'
        ]);

        DB::table('questions')->insert([
            'question' => 'Welche der folgenden Aussagen über lokale Extremwerte ist richtig?',
            'quiz_id' => 6,
            'answerA' => 'Besitzt $f$ an der Stelle $\vec{x}_0$ einen lokalen Extremwert, so ist $\dfrac{\partial f}{\partial x_1}(\vec{x}_0)=0$.',
            'answerB' => '$f$ besitzt eine lokales Minimum, falls $\dfrac{\partial^2 f}{\partial x_1^2}<0$ und $|H_f(\vec{x}_0)|>0$ .',
            'answerC' => 'Ist $\nabla f(\vec{x}_0)=\vec{0}$, so besitzt $f$ an der Stelle $\vec{x}_0$ ein lokales Minimum oder Maximum.',
            'answerD' => 'Besitzt $f$ an der Stelle $\vec{x}_0$ keinen lokalen Extremwert, so gilt $|H_f(\vec{x}_0)| \le 0$.',
            'correct_answers' => '{"a": true, "b": false, "c": false, "d": false}'
        ]);


    }
}
