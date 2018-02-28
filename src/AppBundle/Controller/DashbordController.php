<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\ScpfData;
use AppBundle\Repository\ScpfDataRepository;

class DashbordController extends Controller
{
    public function graphAction()
    { 
        $ScpfData = $this->getDoctrine()
        ->getRepository(ScpfData::class);

        $dateO = $ScpfData->findByDateOpenAcc();
        $dateC = $ScpfData->findByDateCloseAcc();
        $quantityOstr = $ScpfData->findByQuantityOpenAcc();
        $quantityCC = $ScpfData->findByQuantityCloseAcc();

            //преобразование массивов с количеством счетов
        $result = array();
        $quantityO = explode(',', $quantityOstr);
        $result = array_fill(0, count($quantityO), 0);
        $quantityC = array_merge($result, $quantityCC);

        $quantityCstr = implode(",", $quantityC);

            //преобразование массивов с датами
        $dateOresult = array();
        $dateCresult = array();
        foreach ($dateO as $do) {
            $dateOresult[] = '"'.$do.'"';
        }
        foreach ($dateC as $dc) {
            $dateCresult[] = '"'.$dc.'"';
        }
        //array_shift($dateCresult);
        $date = array_merge($dateOresult, $dateCresult);
        $datestr = implode(',', $date);

        return $this->render('AppBundle:Dashbord:graph.html.twig', array(
            'datestr' => $datestr,
            'quantityO' => $quantityOstr,
            'quantityC' => $quantityCstr
        ));
    }

}
