import editProfileCtrl from './edit-profile.controller';
import editProfileTpl from './edit-profile.html';

profileCtrl.$inject = ['$rootScope', '$scope', '$state', '$user', '$uibModal'];
export default function profileCtrl ($rootScope, $scope, $state, $user, $uibModal) {

    /** Hide avatar upload form in default */
    $scope.user = $user.getUser();
    
    $scope.edit = function () {
        var token = $scope.user.token;
        
        var modalInstance = $uibModal.open({
            template: editProfileTpl,
            controller: editProfileCtrl,
            resolve: {
                items: {
                    user: angular.copy($scope.user)
                }
            }
        });

        modalInstance.result.then(function (result) {
            $scope.user.name = result.name;
            $scope.user.email = result.email;
            $scope.user.phone = result.phone;
            $scope.user.avatar = result.avatar;
            
            $user.setUser($scope.user);

            $state.reload();
        });
    };
}
