<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 17/11/2017
 * Time: 22:00
 */

namespace FilmBundle\Controller;

use FilmBundle\Entity\Films;
use FilmBundle\Entity\Genres;
use FilmBundle\Entity\Productions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Class BackController
 * @package FilmBundle\Controller
 */
class BackController extends Controller
{
    /**
     * List of films
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('FilmBundle:Films');
        $films = $repository->findAllFilmByOrder();

        return $this->render('FilmBundle:Back:index.html.twig', array('films' => $films));
    }

    /**
     * Add a movie
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function insertFilmAction(Request $request)
    {
        $form = $this->createForm('FilmBundle\Form\FilmsType', new Films(), array(
            'attr' => array(
                'class' => 'form'
            )
        ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'))
            ->add('clear', ResetType::class, array(
                'label' => 'Effacer'));

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $film = $form->getData();
            $em->persist($film);
            $em->flush();

            $logger = $this->get('logger');
            $logger->info('Adding a movie in the Films entity');

            return $this->redirect($this->generateUrl('admin_homepage'));
        }

        return $this->render('FilmBundle:Back:insertFilm.html.twig', array('form_film' => $form->createView()));
    }

    /**
     * Add a genre
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function insertGenreAction(Request $request)
    {
        $form = $this->createForm('FilmBundle\Form\GenresType', new Genres(), array(
            'attr' => array(
                'class' => 'form'
            )
        ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $genre = $form->getData();
            $em->persist($genre);
            $em->flush();

            $logger = $this->get('logger');
            $logger->info('Adding a genre in the Genres entity');

            return $this->redirect($this->generateUrl('admin_genre_show'));
        }

        return $this->render('FilmBundle:Back:insertGenre.html.twig', array('form_genre' => $form->createView()));
    }

    /**
     * Add a production
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function insertProdAction(Request $request)
    {
        $form = $this->createForm('FilmBundle\Form\ProductionsType', new Productions(), array(
            'attr' => array(
                'class' => 'form'
            )
        ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $prod = $form->getData();
            $em->persist($prod);
            $em->flush();

            $logger = $this->get('logger');
            $logger->info('Adding a production in the Productions entity');

            return $this->redirect($this->generateUrl('admin_prod_show'));
        }

        return $this->render('FilmBundle:Back:insertProd.html.twig', array('form_prod' => $form->createView()));
    }

    /**
     * Modify the film
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function modifyFilmAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository('FilmBundle:Films')->find($id);

        $form = $this->createForm('FilmBundle\Form\FilmsType', $film, array(
            'attr' => array(
                'class' => 'form'
            )
        ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()){
            $film = $form->getData();
            $em->persist($film);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_homepage'));
        }

        return $this->render('FilmBundle:Back:modifyFilm.html.twig', array('form_film' => $form->createView()));
    }

    /**
     * Modify the genre
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function modifyGenreAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $genre = $em->getRepository('FilmBundle:Genres')->find($id);

        $form = $this->createForm('FilmBundle\Form\GenresType', $genre, array(
            'attr' => array(
                'class' => 'form'
            )
        ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()){
            $genre = $form->getData();
            $em->persist($genre);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_genre_show'));
        }

        return $this->render('FilmBundle:Back:modifyGenre.html.twig', array('form_genre' => $form->createView()));
    }

    /**
     * Modify the production
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function modifyProdAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $prod = $em->getRepository('FilmBundle:Productions')->find($id);

        $form = $this->createForm('FilmBundle\Form\ProductionsType', $prod, array(
            'attr' => array(
                'class' => 'form'
            )
        ))
            ->add('submit', SubmitType::class, array(
                'label' => 'Enregistrer'
            ));

        $form->handleRequest($request);

        if ($request->isMethod('POST') && $form->isValid()){
            $prod = $form->getData();
            $em->persist($prod);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_prod_show'));
        }

        return $this->render('FilmBundle:Back:modifyProd.html.twig', array('form_prod' => $form->createView()));
    }

    /**
     * Complete film file
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showFilmAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('FilmBundle:Films');
        $film = $repository->findFullMovie($id);

        return $this->render('FilmBundle:Back:showFilm.html.twig', array('film' => $film));
    }

    /**
     * List of genres
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showGenreAction(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('FilmBundle:Genres');
        $genres = $repository->findAllGenreByOrder();

        return $this->render('FilmBundle:Back:showGenre.html.twig', array('genres' => $genres));
    }

    /**
     * List of productions
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showProdAction(Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('FilmBundle:Productions');
        $prods = $repository->findAllProdByOrder();

        return $this->render('FilmBundle:Back:showProd.html.twig', array('prods' => $prods));
    }

    /**
     * Remove genre
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteGenreAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $genre = $em->getRepository('FilmBundle:Genres')->find($id);
        $em->remove($genre);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_genre_show'));
    }

    /**
     * Remove production
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteProdAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $prod = $em->getRepository('FilmBundle:Productions')->find($id);
        $em->remove($prod);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_prod_show'));
    }

    /**
     * Remove film
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteFilmAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $film = $em->getRepository('FilmBundle:Films')->find($id);
        $em->remove($film);
        $em->flush();

        return $this->redirect($this->generateUrl('admin_homepage'));
    }
}
