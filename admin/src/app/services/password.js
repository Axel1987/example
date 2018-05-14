import passwordModalCrts from './injections/password/password';
import passwordModalTpl from './injections/password/password.html';

passwordService.$inject = ['$uibModal', '$http', 'env'];

export default function passwordService($uibModal, $http, env) {
    
    var _setPassword = function (user) {
        var modalInstance = $uibModal.open({
            template: usersModalTemplate,
            controller: usersModalCtrl,
            resolve: {
                items: {
                    user: user
                }
            }
        });

        return modalInstance.result.then(function (result) {
            return result;
        });
    };

    var _changePassword = function (user) {
        var modalInstance = $uibModal.open({
            template: passwordModalTpl,
            controller: passwordModalCrts,
            resolve: {
                items: {
                    user: user
                }
            }
        });
    };
    
    
    return {
        setPassword: _setPassword,
        changePassword: _changePassword
    }
}
