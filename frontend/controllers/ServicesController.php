<?php

namespace frontend\controllers;

class ServicesController extends \yii\web\Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Displays services-doctor-visit page.
     *
     * @return mixed
     */
    public function actionDoctorVisit() {
        return $this->render('doctor-visit');
    }

    /**
     * Displays services-nursing-care page.
     *
     * @return mixed
     */
    public function actionNursingCare() {
        return $this->render('nursing-care');
    }

    /**
     * Displays services-caregiver-service page.
     *
     * @return mixed
     */
    public function actionCaregiver() {
        return $this->render('caregiver-service');
    }

    /**
     * Displays services-laboratory page.
     *
     * @return mixed
     */
    public function actionLaboratory() {
        return $this->render('laboratory');
    }

    /**
     * Displays services-pharmacy page.
     *
     * @return mixed
     */
    public function actionPharmacy() {
        return $this->render('pharmacy');
    }

    /**
     * Displays services-equipment-hire page.
     *
     * @return mixed
     */
    public function actionEquipmentHire() {
        return $this->render('equipment-hire');
    }

    /**
     * Displays services-health-check-up page.
     *
     * @return mixed
     */
    public function actionHealthCheckUp() {
        return $this->render('health-check-up');
    }

    /**
     * Displays services-equipment page.
     *
     * @return mixed
     */
    public function actionEquipment() {
        return $this->render('equipment');
    }

    /**
     * Displays services-mobile-pharmacy page.
     *
     * @return mixed
     */
    public function actionMobilePharmacy() {
        return $this->render('mobile-pharmacy');
    }

    /**
     * Displays services-software page.
     *
     * @return mixed
     */
    public function actionSoftware() {
        return $this->render('software');
    }

    /**
     * Displays services-welfare page.
     *
     * @return mixed
     */
    public function actionWelfare() {
        return $this->render('welfare');
    }

    /**
     * Displays services-meals-on-wheels page.
     *
     * @return mixed
     */
    public function actionMealsOnWheels() {
        return $this->render('meals-on-wheels');
    }

    /**
     * Displays services-handyman-service page.
     *
     * @return mixed
     */
    public function actionHandymanService() {
        return $this->render('handyman-service');
    }

    /**
     * Displays services-mobile-hairdressing-service page.
     *
     * @return mixed
     */
    public function actionMobileHairdressingService() {
        return $this->render('mobile-hairdressing-service');
    }

    /**
     * Displays other-services page.
     *
     * @return mixed
     */
    public function actionAirAmbulance() {
        return $this->render('air-ambulance');
    }

    public function actionCouncellingPsychologist() {
        return $this->render('councelling-psychologist');
    }

    public function actionAmbulance() {
        return $this->render('ambulance');
    }

     public function actionOtherServices() {
        return $this->render('other-services');
    }
    
   public function actionPhysiotherapy() {
                return $this->render('physiotherapy');
        }

        public function actionDietitian() {
                return $this->render('dietitian');
        }

        public function actionSpeechTherapy() {
                return $this->render('speech-therapy');
        }

}
