import infoModalCtrl from './injections/info/info.modal.controller';
import jobInfoTpl from './injections/info/job-info.html'; 
import userInfoTpl from './injections/info/user-info.html';
import reviewInfoTpl from './injections/info/review-info.html';

infoService.$inject = ['$uibModal'];

export default function infoService($uibModal) {

    /** Open info modal */
    var _openModal = function (template, infoObj) {
        $uibModal.open({
            template: template,
            controller: infoModalCtrl,
            resolve: {
                items: {
                    infoObj: infoObj
                }
            }
        });
    },

    /** Open info from job */
    _jobInfo = function (job) {
        _openModal(jobInfoTpl, job);
    },

    /** Open info from user */
    _userInfo = function (user) {
        _openModal(userInfoTpl, user);
    },

    /** Open review */
    _reviewInfo = function (review) {
        _openModal(reviewInfoTpl, review);
    };

    
    return {
        jobInfo : _jobInfo,
        userInfo: _userInfo,
        reviewInfo : _reviewInfo
    }

}