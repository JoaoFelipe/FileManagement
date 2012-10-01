cmake_minimum_required(VERSION 2.4.6)
include($ENV{ROS_ROOT}/core/rosbuild/rosbuild.cmake)

# Set the build type.  Options are:
#  Coverage       : w/ debug symbols, w/o optimization, w/ code-coverage
#  Debug          : w/ debug symbols, w/o optimization
#  Release        : w/o debug symbols, w/ optimization
#  RelWithDebInfo : w/ debug symbols, w/ optimization
#  MinSizeRel     : w/o debug symbols, w/ optimization, stripped binaries
set(ROS_BUILD_TYPE RelWithDebInfo)

rosbuild_init()

#set the default path for built executables to the "bin" directory
set(EXECUTABLE_OUTPUT_PATH ${PROJECT_SOURCE_DIR}/bin)
#set the default path for built libraries to the "lib" directory
set(LIBRARY_OUTPUT_PATH ${PROJECT_SOURCE_DIR}/lib)

#uncomment if you have defined messages
rosbuild_genmsg()
#uncomment if you have defined services
rosbuild_gensrv()

#common commands for building c++ executables and libraries
#rosbuild_add_library(${PROJECT_NAME} src/example.cpp)
#target_link_libraries(${PROJECT_NAME} another_library)
#rosbuild_add_boost_directories()
#rosbuild_link_boost(${PROJECT_NAME} thread)
#rosbuild_add_executable(example examples/example.cpp)
#target_link_libraries(example ${PROJECT_NAME})

#find_package(OpenCV REQUIRED)

#rosbuild_add_executable(table src/Table.cpp)
#rosbuild_add_executable(drawX src/DrawX.cpp)
#rosbuild_add_executable(mapWindow src/MapWindow.cpp)
#rosbuild_add_executable(mainWindow src/MainWindow.cpp)

include($ENV{ROS_ROOT}/core/rosbuild/FindPkgConfig.cmake)

rosbuild_add_library(Window src/MainWindow.cpp src/MapWindow.cpp src/DrawX.cpp src/Table.cpp src/ParametersTable.cpp src/Tasks.cpp)

TARGET_LINK_LIBRARIES( Window fltk Xext X11 m fltk_images fltk_forms fltk_gl boost_thread boost_system boost_filesystem boost_regex opencv_highgui opencv_core opencv_imgproc )

include_directories(/usr/local/include)
link_directories(/usr/local/lib)

rosbuild_add_executable(interface src/Interface.cpp)
#rosbuild_add_compile_flags( interface -fPIC)
#link_directories (/usr/local/lib  /usr/local/lib64)
#target_link_libraries(table fltk Xext X11 m)
#target_link_libraries(drawX fltk Xext X11 m fltk_images fltk_jpeg fltk_forms fltk_gl)
#target_link_libraries(mapWindow fltk Xext X11 m)
#target_link_libraries(mainWindow fltk Xext X11 m)
target_link_libraries(interface fltk Xext X11 m fltk_images fltk_forms fltk_gl boost_thread boost_system boost_filesystem boost_regex Window)


include_directories(${CMAKE_CURRENT_BINARY_DIR})
